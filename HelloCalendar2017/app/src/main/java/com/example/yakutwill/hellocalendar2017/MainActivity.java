package com.hellocalendar.yakutwill.hellocalendar2017;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //별거없다 밑은 현재 수정일자를 받아오는 테스트 ok
        TextView test1 = (TextView) findViewById(R.id.testtext);
        MakeNowDate makenowdate = new MakeNowDate();
        test1.setText(makenowdate.getRightnow());

        //Show Temp Memo 구현
        Button tempbutton = (Button)findViewById(R.id.TempButton);
        tempbutton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent totempmemo = new Intent(MainActivity.this, Memojang.class);
                MakeNowDate makenowdate = new MakeNowDate();
                String nowdate = makenowdate.getRightnow();
                totempmemo.putExtra("nowdate",nowdate);
                totempmemo.putExtra("Istemp","yes");
                startActivity(totempmemo);
            }
        });

        //CalendarView를 누르면 현재 날짜를 testText에 추가시킴
        CalendarView calendarview = (CalendarView)findViewById(R.id.calendarView);
        calendarview.setOnDateChangeListener(new CalendarView.OnDateChangeListener() {
            @Override
            public void onSelectedDayChange(@NonNull CalendarView view, int year, int month, int dayOfMonth) {
                String selectedDate = "작성 날짜 : ";
                selectedDate += Integer.toString(year)+"_";
                selectedDate += Integer.toString(month) + 1 + "_";
                selectedDate += Integer.toString(dayOfMonth);

                //수정일시를 받기 위해 MakeNowDate()객체를 만들어서 넣어준다
                MakeNowDate mk = new MakeNowDate();

                Intent totempmemo = new Intent(MainActivity.this, Memojang.class);
                totempmemo.putExtra("Istemp", "no");
                totempmemo.putExtra("selectedDate", selectedDate);
                totempmemo.putExtra("nowdate",mk.getRightnow());
                Toast.makeText(getApplicationContext(), selectedDate, Toast.LENGTH_SHORT).show();
                startActivity(totempmemo);
            }
        });


    }
}
