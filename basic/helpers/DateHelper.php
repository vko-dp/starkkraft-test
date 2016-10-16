<?php
/**
 * Created by PhpStorm.
 * User: Varenko Oleg
 * Date: 16.10.2016
 * Time: 16:51
 */

namespace app\helpers;


class DateHelper
{
    /**
     * @var array список месяцев
     */
    protected static $_monthList = array(
        1  => 'Январь',
        2  => 'Февраль',
        3  => 'Март',
        4  => 'Апрель',
        5  => 'Май',
        6  => 'Июнь',
        7  => 'Июль',
        8  => 'Август',
        9  => 'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
    );

    /**
     * Возвращает список месяцев
     * @static
     * @return array
     */
    public static function getMonthList() {
        return self::$_monthList;
    }

    /**
     * @param $num
     * @return string
     */
    public static function getMonth($num) {
        return isset(self::$_monthList[$num]) ? self::$_monthList[$num] : '';
    }
}