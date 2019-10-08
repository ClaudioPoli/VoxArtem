package org.altervista.httpvoxartem.voxartem;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.support.v4.app.FragmentActivity;
import android.support.v4.view.ViewPager;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.VideoView;

/**
 * Main Activity of the Vox Artem app
 */
public class MainActivity extends FragmentActivity {

    /**
     * Initializing the activity with the corresponding layout
     *
     * @param savedInstanceState previous saved state; if null the activity never existed on the
     *                           device
     */
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Setting a ViewPager object that will handle the fragments
        ViewPager viewPager = (ViewPager) findViewById(R.id.viewpager);
        viewPager.setAdapter(new FragmentAdapter(this, getSupportFragmentManager()));

        // Fragments will be shown using tabs with the TabLayout
        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        tabLayout.setupWithViewPager(viewPager);
    }


    /**
     * Sets the result of the QR Code scan as the activityToFragment TextView text
     *
     * @param requestCode code of the request
     * @param resultCode  result of the scan
     * @param intent      intent sent on the camera app for the scan
     */
    public void onActivityResult(int requestCode, int resultCode, Intent intent) {
        if (requestCode == 0) {
            if (resultCode == RESULT_OK) {
                String contents = intent.getStringExtra("SCAN_RESULT");
                TextView activityToFragment = (TextView) findViewById(R.id.activity_to_fragment);
                TextView qrResult = (TextView) findViewById(R.id.qr_result);

                if (qrResult.getText().toString().isEmpty())
                    changeQRLayout(qrResult);

                activityToFragment.setText(contents);
            }
        }
    }


    /**
     * If the scanButton is clicked in the qr fragment an intent will be thrown to the camera app
     * to scan the QR Code
     *
     * @param view view calling the method
     */
    public void scan(View view) {
        Intent intent = new Intent("com.google.zxing.client.android.SCAN");
        intent.putExtra("SCAN_MODE", "QR_CODE_MODE");
        startActivityForResult(intent, 0);
    }


    /**
     * If the first scan is executed the layout of the qr fragment will be changed
     */
    public void changeQRLayout(TextView qrResult) {
        // Getting all the views that will change in the layout
        TextView title = (TextView) findViewById(R.id.qr_title);
        Button playPauseButton = (Button) findViewById(R.id.play_pause);
        Button stopButton = (Button) findViewById(R.id.stop);
        TextView backgroundMusic = (TextView) findViewById(R.id.background_music);
        VideoView videoView = (VideoView) findViewById(R.id.video_view);
        ImageView qrImage = (ImageView) findViewById(R.id.qr_image);
        Button speakButton = (Button) findViewById(R.id.speak_button);

        // Seting the visibility of the views
        qrImage.setVisibility(View.GONE);
        speakButton.setVisibility(View.VISIBLE);
        qrResult.setVisibility(View.VISIBLE);
        title.setVisibility(View.VISIBLE);
        playPauseButton.setVisibility(View.VISIBLE);
        stopButton.setVisibility(View.VISIBLE);
        backgroundMusic.setVisibility(View.VISIBLE);
        videoView.setVisibility(View.VISIBLE);
    }
}