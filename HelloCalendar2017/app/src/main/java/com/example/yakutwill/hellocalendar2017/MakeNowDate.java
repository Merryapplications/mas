package com.hellocalendar.yakutwill.hellocalendar2017;

import java.util.Calendar;

/**
 * Created by Yakutwill on 2017-03-24.
 */

public class MakeNowDate {

    //객체를 만드는 순간의 현재 날짜의 객체를 받는다.
    Calendar mCalendar = Calendar.getInstance();
    int year = mCalendar.get(Calendar.YEAR);
    int month = mCalendar.get(Calendar.MONTH)+1;
    int dayofmonth = mCalendar.get(Calendar.DAY_OF_MONTH);
    int hour = mCalendar.get(Calendar.HOUR);
    int minute = mCalendar.get(Calendar.MINUTE);
    String rightnow = "수정 일시 : "+Integer.toString(year)+"_"+Integer.toString(month)+"_"+Integer.toString(dayofmonth)+"_"+Integer.toString(hour)+"_"+Integer.toString(minute);

    //객체를 만든 순간의 일시를 String으로 내보낸다.
    public String getRightnow(){
        return rightnow;
    }
}
