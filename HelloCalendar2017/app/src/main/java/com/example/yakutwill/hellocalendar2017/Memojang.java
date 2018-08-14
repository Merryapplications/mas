package com.hellocalendar.yakutwill.hellocalendar2017;

import android.content.Context;
import android.content.Intent;
import android.os.Environment;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.view.menu.ExpandedMenuView;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.PrintWriter;

public class Memojang extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_memojang);

        Intent getintent = getIntent();
        final EditText memoedittext = (EditText)findViewById(R.id.MemoEditText);

        final Button savebutton = (Button)findViewById(R.id.SaveMemoButton);
        final Button deletebutton = (Button)findViewById(R.id.MemoDeleteButton);



        //TempMemo일때
        if(getintent.getStringExtra("Istemp").equals("yes")){

            //바로 밑 부분에 버튼을 누르면 Temp.txt를 읽어 오는 것을 만들어야지!, Try Catch 해서 위의 것을 복사해오자.
                try{
                    Log.v("Tag","Temp.txt파일을 읽으려고 시도합니다.");

                    //있으면 상관없고 없으면 만들고
                    FileOutputStream fos = openFileOutput("Temp.txt", Context.MODE_APPEND);
                    //fos.close();
                    Log.v("Tag", "Temp.txt파일 생성완료");

                    /*
                    try문 안에서는 작동하지 않는건가? 밖으로 빼내보자
                    BufferedReader br = new BufferedReader(new InputStreamReader(new FileInputStream("Temp.txt")));
                    StringBuffer sb = new StringBuffer();
                    String str;
                    */
                    try {
                        InputStream in = openFileInput("Temp.txt");
                        InputStreamReader inr = new InputStreamReader(in);
                        BufferedReader br = new BufferedReader(inr);
                        StringBuffer sb = new StringBuffer();
                        String str;

                        Log.v("Tag", "리드라인 전까지 완료, 바로 밑의 while문 ");
                        //무언가 fis.read에 있다면 즉, fis.read()가 참이라면
                        while ((str = br.readLine())!= null) {
                            sb.append(str+"\n");
                        }
                        br.close();
                        memoedittext.setText(sb);
                        Log.v("Tag", "리드라인까지 완료, 바로 위의 mmoedittext 완료");
                    }catch(Exception x){
                        Log.v("tag", "문제발생");
                    }
                }catch (Exception e){
                    //임시 메모장, 밑은 확인용 ok
                    memoedittext.setText("임시 메모장"+"\n"+getintent.getStringExtra("nowdate"));
                    Log.v("Tag", "Temp.txt파일을 초기화 읽을 수 없습니다.");
                    Log.v("Tag", "Temp.txt 파일 생성합니다.");
                    try {
                        openFileOutput("Temp.txt", Context.MODE_APPEND);
                    }catch (Exception f){
                        Log.v("Tag","초기화 Temp.txt파일이 없어서 만들었습니다.");

                    }
                }


                //여기에서 savebutton이 눌리면 동작하는 것을 만든다
                savebutton.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        //text파일을 생성한다
                        try {
                            //본래 파일을 delete한다.
                        deleteFile("Temp.txt");
                        FileOutputStream fos = openFileOutput("Temp.txt", Context.MODE_APPEND);
                        PrintWriter printWriter = new PrintWriter(fos);
                        printWriter.println(memoedittext.getText());
                        printWriter.close();
                        memoedittext.setText("");
                        Log.v("Tag","Temp.txt파일을 정상적으로 저장했습니다!");

                            //Temp.txt파일을 읽어온다.
                            try{
                                Log.v("Tag","SaveButton을 눌러을 때 Temp.txt파일을 읽으려고 시도합니다.");
                                InputStream in = openFileInput("Temp.txt");
                                InputStreamReader inr = new InputStreamReader(in);
                                BufferedReader br;
                                br = new BufferedReader(inr);
                                StringBuffer sb = new StringBuffer();
                                String str="";
                                //무언가 fis.read에 있다면 즉, fis.read()가 참이라면
                                Log.v("Tag","SaveButton을 눌렀을 때 While전까지 완료 되었습니다.");
                                while ((str=br.readLine()) != null) {
                                    sb.append("\n"+str);
                                }
                                br.close();
                                memoedittext.setText(sb);
                            }catch (Exception e){
                                Log.v("Tag", "SaveButton을 눌렀을 때 Temp.txt파일을 읽을 수 없습니다.");
                            }

                    }catch (Exception e){
                        Log.v("Tag","Temp.txt파일을 만드는 것에 실패했습니다.");
                    }

                    }
                });

            //여기에서 deletebutton 눌리면 동작하는 것을 만든다.
            deletebutton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                        try{
                            deleteFile("Temp.txt");
                            memoedittext.setText("");
                            Log.v("Tag", "Temp.txt파일 삭제 완료");

                        }catch (Exception e){
                            Log.v("Tag","Temp.txt를 삭제할 수 없습니다");
                        }
                }
            });

        }

        //DatedMemo일때
        else if(getintent.getStringExtra("Istemp").equals("no")){
            Log.v("Tag", "Dated메모로 접근했습니다.");
            Intent datedintent = getIntent();

            //nameoffile 뒤에 .txt 확장자를 붙여줬다.
            final String nameoffile = datedintent.getStringExtra("selectedDate").toString()+".txt";

            //실제 절대 경로를 받아오는 문법
            String dirPath = getFilesDir().getAbsolutePath();
            //1번 파일의 전체 경로를 써준다 File afile = new File(dirPath+"/"+nameoffile);
            //2번 파일의 이름만 써준다
            File afile = new File(dirPath+"/"+nameoffile);
            memoedittext.setText("현재 경로 : "+dirPath+"\n"+"파일이름 : "+nameoffile+"\n"+datedintent.getStringExtra("nowdate"));

            //dirPath아래에 nameoffile이 있는지 없는지 검사하는 if문
            if(afile.exists()){
                Log.v("Tag", "지정된 nameoffile의 이름을 가진 파일이 있습니다.");

                //파일이 있다면 읽어와서 edittext에 써준다.
                try{
                    Log.v("Tag","이미 있는 파일의 텍스트를 읽어오려고 합니다.");
                    InputStream in = openFileInput(nameoffile);
                    InputStreamReader inr = new InputStreamReader(in);
                    BufferedReader br;
                    br = new BufferedReader(inr);
                    StringBuffer sb = new StringBuffer();
                    String str="";
                    //무언가 fis.read에 있다면 즉, fis.read()가 참이라면
                    Log.v("Tag","이미 있는 파일의 while문 전까지 완료했습니다.");
                    while ((str=br.readLine()) != null) {
                        sb.append("\n"+str);
                    }
                    br.close();
                    memoedittext.setText(sb);
                    Log.v("Tag", "이미 있는 파일을 다 읽었습니다.");

                }catch (Exception e){
                    Log.v("Tag", "SaveButton을 눌렀을 때 Temp.txt파일을 읽을 수 없습니다.");
                }


            }else{
                //파일이 없다면
                Log.v("Tag", "지정된 nameoffile이 없습니다.");
                //파일을 만들어보자
                try{
                    Log.v("Tag", "파일 생성 시도!");

                    //openFileOutput에 넣을때 맨 앞의 인자는 꼭 "고정값.txt"이어야 한다??? nameoffile은 String으로 잘 받았는데 문제네... 고정값이어야하나.
                    //FileOutputStream fos = openFileOutput(nameoffile, Context.MODE_APPEND); 작동을 하지 않아서 다른 방법 찾음

                    File bfile = new File(dirPath+"/"+nameoffile);
                    Log.v("Tag","새롭게 만든 파일의 위치는 "+bfile+" 입니다.");
                    Log.v("Tag", "파일 생성 완료!");

                }catch (Exception e){
                    Log.v("Tag", "파일 생성 문제발생!");
                }
            }

            //Save버튼이 눌려졌을 때 실행되는 부분
            //똑같은 savebutton을 사용하니까 오류가 났네....음... 그럼 그냥 새로 만들어야겠다 아마 중복오류는 아닐수도있는데
            savebutton.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v){
                    String tempstring = memoedittext.getText().toString();

                    deleteFile(nameoffile);

                    try {
                        FileOutputStream fos = openFileOutput(nameoffile, Context.MODE_APPEND);
                        PrintWriter pw = new PrintWriter(fos);
                        pw.append(tempstring);
                        pw.close();
                        Log.v("Tag", "save button을 눌렀는데 잘 저장 되었습니다.");
                    }catch(Exception e){
                        Log.v("Tag", "Save버튼 눌렀을 때 문제 발생했습니다");
                    }

                }
            });


            //Delete버튼이 눌려졌을 때 실행되는 부분
            deletebutton.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v){
                    deleteFile(nameoffile);
                    Log.v("Tag", "파일이 잘 삭제 되었습니다");
                }
            });



        }


    }
}
