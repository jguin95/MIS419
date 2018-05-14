package com.example.jonathan.myapp4;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.EditText;

import java.text.SimpleDateFormat;
import java.util.Date;

public class MainActivity extends AppCompatActivity {
    public static final String EXTRA_USEREMAIL = "com.example.myapp4.USEREMAIL";
    public static final String EXTRA_PASSWORD = "com.example.myapp4.PASSWORD";
    public static final String EXTRA_DATE = "com.example.myapp4.DATE";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        EditText editDate = (EditText) findViewById(R.id.editText3);
        String date = new SimpleDateFormat("yyyy-MM-dd").format(new Date());
        editDate.setText(date);

    }


    public void sendMessage(View view) {
        // Do something in response to button
        Intent intent = new Intent(this, DisplayMessageActivity.class);

        EditText editUser = (EditText) findViewById(R.id.editText);
        String email = editUser.getText().toString();

        EditText editPassword = (EditText) findViewById(R.id.editText2);
        String PW = editPassword.getText().toString();

        EditText editDate = (EditText) findViewById(R.id.editText3);
        String date = editDate.getText().toString();

        intent.putExtra(EXTRA_USEREMAIL, email);
        intent.putExtra(EXTRA_PASSWORD, PW);
        intent.putExtra(EXTRA_DATE, date);
        startActivity(intent);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
