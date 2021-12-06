

//эта функция добавляет месяцы к дате (я списала ее откуда-то, учитывает число дней в месяце!)
export function addMonths(date, months) {
    var d = date.getDate(); //чтобы это работало, должны подать сюда формат даты
    date.setMonth(date.getMonth() + +months);
    if (date.getDate() != d) {
      date.setDate(0);
    }
    return date;
}

