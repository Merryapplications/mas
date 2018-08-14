package com.hellocalendar.yakutwill.hellocalendar2017;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ListView;

public class ShowAllMemos extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show_all_memos);

        ListView alistview = (ListView)findViewById(R.id.AllMemosList);



    }
}
