package com.example.jonathan.myapp4;

import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.logging.Level;
import java.util.logging.Logger;

public class DisplayMessageActivity extends AppCompatActivity {

    // IMPORTANT NOTE: Remember to include the following in the AndroidManifest.xml
    // file for this application because of the need to use the network connection
    // <uses-permission android:name="android.permission.INTERNET" />
    // <uses-permission android:name="android.permission.ACCESS_NETWORK_STATE" />

    // here's the location of the web service
    private static final String serviceUrl = "http://www.guinhq.com/oxfordcc/getsomevalue.php";

    // this is a tag that's written into the log to make it easy to do a quick
    // search in the log for communication errors generated when the program
    // is running on the emulator.
    private static final String DEBUG_TAG = "BR_TAG";

    // this is where we will place the numerical value returned by the web service
    private int todaysCount;
    private int todaysuncount;
    private int todayswage;
    private String sdate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_display_message);

        // Get the user credentials from the intent
        Intent intent = getIntent();
        String username = intent.getStringExtra(MainActivity.EXTRA_USEREMAIL);
        String password = intent.getStringExtra(MainActivity.EXTRA_PASSWORD);
        String searchDate = intent.getStringExtra(MainActivity.EXTRA_DATE);

        sdate = searchDate;
        // build a JSON string to send credentials to web service
        // remember that the PHP script is expecting these specific JSON
        // keys: account_email    account_password
        // along with the values provided by the person running the program
        String JSONtoPost = "";
        try {
            JSONObject jsonCredentials = new JSONObject();
            jsonCredentials.put("account_email", username);
            jsonCredentials.put("account_password", password);
            jsonCredentials.put("search_date", searchDate);
            JSONtoPost = jsonCredentials.toString();
            Log.d(DEBUG_TAG,JSONtoPost);
        }
        catch(JSONException e) {
            e.printStackTrace();
        }

        // initialize variable to a signal value in case of failure
        // note that this variable is "global" within this activity class
        // and it is set in one of the later functions after a successful connection
        // with the web service

        todaysCount = -1;
        todaysuncount = -1;
        todayswage = -1;

        // check the status of the network connection
        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        // if we have a live connection, use it, otherwise, show an error
        if (networkInfo != null && networkInfo.isConnected()) {
            // fetch data
            new DownloadSomeValueTask().execute(serviceUrl,JSONtoPost);
        } else {
            // display error
            Toast.makeText(getApplicationContext(),
                    "Sorry -- No Network Connection Available", Toast.LENGTH_LONG)
                    .show();
        }

        // At this point, the communication subtask has been launched.
        // It runs separately/independently from this execution thread in this
        // function.
        //
        // Note that all subsequent success/failure messaging onscreen to the user
        // is now going to be handled within that other asynchronous task (that other
        // thread of execution).
        //

        // let's put a placeholder notice onscreen while that other thread runs
        String displayResults = "Lookup pending...";

        TextView textResults = (TextView) findViewById(R.id.textView);
        textResults.setText(displayResults);

        // nothing else to do at this point; remember that the other
        // thread is still running independently.  But this OnCreate function
        // ends now.
    } // end of onCreate()

    // Uses AsyncTask to create a task away from the main UI thread. This task takes a
    // URL string and uses it to create an HttpUrlConnection. Once the connection
    // has been established, the AsyncTask downloads the contents of the response
    // using a BufferedReader. Finally, the data retrieve via the BufferedReader
    // is stored in a StringBuilder instance that is converted into a string, which is
    // displayed in the UI by the AsyncTask's onPostExecute method.
    //
    // The Android environment expects you to handle communications tasks in these
    // kinds of separate, async tasks, so that you don't lock up the user's screen.
    //
    private class DownloadSomeValueTask extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... urls) {

            // params comes from the execute() call: params[0] is the url.
            // params comes from the execute() call: params[1] is the JSON.
            try {
                return downloadUrl(urls[0], urls[1]);
            } catch (IOException e) {
                return "Unable to retrieve response. URL or JSON may be invalid.";
            }
        } // end doInBackground function


        // onPostExecute displays the results of the AsyncTask.
        @Override
        protected void onPostExecute(String result) {

            // note that the PHP webservice sends back
            // this specific value "INVALIDCREDENTIALS"  if the DB lookup
            // fails.  See the end of the PHP script for this code.
            //
            if(result.equals("INVALIDCREDENTIALS")) {
                Toast.makeText(getApplicationContext(),
                        "Invalid email address or password", Toast.LENGTH_LONG)
                        .show();

                String displayResults = "Connection not successful";

                TextView textResults = (TextView) findViewById(R.id.textView);
                textResults.setText(displayResults);
            }
            //-------------------------------------------------------------------------
            else if(result.equals("BADCONNECTION")){
                Toast.makeText(getApplicationContext(),
                        "DB Lookup failed", Toast.LENGTH_LONG)
                        .show();

                String displayResults = "Connection not successful";

                TextView textResults = (TextView) findViewById(R.id.textView);
                textResults.setText(displayResults);
            }
            //-------------------------------------------------------------------------
            else {
                // If we're in here, it means the email address and password were
                // successfully found in the database; consequently, the webservice
                // should have sent us a "Count_Value" key back in JSON along with a number.
                //
                // parse JSON into array of strings
                try {

                    JSONObject  jObject = new JSONObject(result);

                    // note that "Count_Value" is one of the JSON keys that should
                    //   have been generated by the PHP web service
                    //   and the todaysCount variable is "global" within this
                    //   activity class

                    todaysCount = jObject.getInt("AH");
                    todaysuncount = jObject.getInt("UH");
                    todayswage = jObject.getInt("Days_Wages");


                    // Here's some debug-related logging.  Take out in production version.
                    Log.d(DEBUG_TAG, "The Approved_Hours are: " + Integer.toString(todaysCount));

                    // get ready to update onscreen message to user
                    String displayResults = "Connection not successful";
                    if(todaysCount>=0)
                        displayResults = "Approved Hours: " + Integer.toString(todaysCount);
                    String displayunhrs = "Unapproved Hours: " + Integer.toString(todaysuncount);
                    String displaywage = "Current Wages: " + Integer.toString(todayswage);
                    String disdate = "Date : " + sdate;
                    // update the TextView control onscreen
                    TextView textResults = (TextView) findViewById(R.id.textView);
                    textResults.setText(displayResults);

                    TextView textResults2 = (TextView) findViewById(R.id.textUH);
                    textResults2.setText(displayunhrs);

                    TextView textResults3 = (TextView) findViewById(R.id.textWage);
                    textResults3.setText(displaywage);

                    TextView textResults4 = (TextView) findViewById(R.id.textDate);
                    textResults4.setText(disdate);

                } catch (Throwable t) {
                    Log.e("My App", "Could not parse malformed JSON: \"" + result + "\"");
                }

            }  // end else
        } // end onPostExecute function
    } //end DownloadSomeValueTask class
    // Given a URL, establishes an HttpUrlConnection, posts the JSON, and retrieves
    // the response content via a BufferedReader, which it returns as
    // a string.
    private String downloadUrl(String myurl, String JSONforPosting) throws IOException {
        BufferedReader br = null; // need this to enable buffered input
        StringBuilder sb = new StringBuilder(); // need this to catch buffered input
        int responseCode = 0;

        try {
            URL url = new URL(myurl);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            conn.setReadTimeout(10000 /* milliseconds */);
            conn.setConnectTimeout(15000 /* milliseconds */);
            conn.setRequestMethod("POST");
            conn.setDoInput(true);
            conn.setDoOutput(true);
            conn.setUseCaches(false);
            conn.setAllowUserInteraction(false);
            conn.setRequestProperty("Content-Type", "application/json");
            conn.setRequestProperty("Accept", "application/json");
            // Starts the query
            conn.connect();
            final OutputStreamWriter osw = new OutputStreamWriter(conn.getOutputStream());
            osw.write(JSONforPosting);
            osw.close();

            responseCode = conn.getResponseCode();
            // note: under "normal" circumstance, we'd comment out this next line
            //       because we would not want to log any "sensitive" data; however,
            //       it's helpful to leave in during debugging/testing
            Log.d(DEBUG_TAG, "The response is: " + responseCode);

            switch (responseCode) {
                case 200:
                case 201:
                    //is = conn.getInputStream();
                    br = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                    String line;
                    while ((line = br.readLine()) != null) {
                        sb.append(line);
                    }
                    br.close();
            }

            // note: under "normal" circumstance, we'd comment out this next line
            //       because we would not want to log any "sensitive" data; however,
            //       it's helpful to leave in during debugging/testing
            Log.d(DEBUG_TAG, "The response string is: " + sb.toString());

            return sb.toString(); //contentAsString;

        } catch (MalformedURLException ex) {
            Logger.getLogger(Log.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(Log.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            // Makes sure that the InputStream is closed after the app is
            // finished using it.
            if (br != null) {
                br.close();
            }
        }
        if(sb.toString().length()>0) {
            return sb.toString(); //contentAsString;
        } else {
            return "***COMM ERROR: "+ String.valueOf(responseCode) +" ***";
        }
    } // end downloadUrl function

}
