-- Задание
-- Преобразовать данные таблицы таким образом, чтобы в ней содержались ТОЛЬКО транзакции-расходы.
-- То есть, все транзакции-возвраты должны быть учтены в предшествующих им транзакциях-расходах.
-- Решение
-- с функцией пересчета и удаления данных возврата в таблице (т.к. не сказано что пересчет делать после поступления возврата - тогда можно было бы сделать триггер)

-- для проверки
SELECT *
FROM data
WHERE date < '2015-09-28 12:50:10'
      AND card_number = '257300116'
      AND address_id = 433
ORDER BY date DESC LIMIT 1;

-- функция пересчета
DELIMITER |
CREATE FUNCTION replaceTableData() RETURNS INT DETERMINISTIC
  BEGIN

    DECLARE replaceRows INT DEFAULT 0;
    DECLARE currDate DATETIME;
    DECLARE currCardNumber VARCHAR(20) DEFAULT '';
    DECLARE currVolume FLOAT DEFAULT 0;
    DECLARE currAddressId INT DEFAULT 0;
    DECLARE done INT DEFAULT 0;
    DECLARE cur CURSOR FOR SELECT date, card_number, volume, address_id FROM data_temp WHERE volume > 0;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- создаем временную таблицу и заполняем ее данными из исходной таблицы
    DROP TEMPORARY TABLE IF EXISTS data_temp;
    CREATE TEMPORARY TABLE data_temp LIKE data;
    INSERT INTO data_temp (id, card_number, date, volume, service, address_id)
      SELECT id, card_number, date, volume, service, address_id FROM data;

    OPEN cur;
    read_loop: LOOP
      FETCH cur INTO currDate, currCardNumber, currVolume, currAddressId;
      IF done THEN LEAVE read_loop; END IF;
      UPDATE data SET data.volume = data.volume + currVolume WHERE id IN (
        SELECT id FROM (
                         SELECT id
                         FROM data
                         WHERE date < currDate
                               AND card_number = currCardNumber
                               AND address_id = currAddressId
                         ORDER BY date DESC LIMIT 1
                       ) AS _t
      );
      SET replaceRows = replaceRows + 1;
    END LOOP;
    CLOSE cur;
    -- удаляем временную таблицу
    DROP TEMPORARY TABLE IF EXISTS data_temp;
    DELETE FROM data WHERE volume > 0;

    RETURN replaceRows;

  END|
DELIMITER ;

-- Вызываем функцию для пересчета
select replaceTableData();

-- для проверки
SELECT *
FROM data
WHERE date < '2015-09-28 12:50:10'
      AND card_number = '257300116'
      AND address_id = 433
ORDER BY date DESC LIMIT 1;
