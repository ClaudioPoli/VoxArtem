package org.altervista.httpvoxartem.voxartem;

import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.speech.tts.TextToSpeech;
import android.support.v4.app.Fragment;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.VideoView;

import java.util.Locale;

/**
 * Fragment to scan the QR Code; after first scan the layou will change
 */
public class QRFragment extends Fragment {

    private TextToSpeech textToSpeech;
    private int resultTextToSpeech;
    private View view;
    private MediaPlayer mediaPlayer = new MediaPlayer();


    /**
     * Empty default constructor
     */
    public QRFragment() { }


    /**
     * Setting the fragment layout
     *
     * @param inflater           inflater that will return the layout for the fragment
     * @param container          if not null it represents the UI that the fragment will show
     * @param savedInstanceState if not null the fragment will be built from a previous saved state
     * @return fragment layout if exists, null otherwise
     */
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_qr, container, false);

        // The activityToFragment TextView will contain the string returned by the QR Code scan;
        // it is invisible to the user
        final TextView activityToFragment = (TextView) view.findViewById(R.id.activity_to_fragment);

        // Listener for the text changing event
        activityToFragment.addTextChangedListener(new TextWatcher() {
            /**
             * Do nothing before the text changes
             * @param s text that will change
             * @param start start index of the change
             * @param count number of characters that will change
             * @param after length of the new text
             */
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) { }

            /**
             * Do nothing while the text is changing
             * @param s text that's being changed
             * @param start start index of the change
             * @param before number of characters modified
             * @param count number of characters that has changed
             */
            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) { }

            /**
             * After the text has been changed the result of the last QR Code scan has been saved
             * in the activityToFragment TextView; the string will be splitted in 4 parts: title,
             * description, audio URL and video URL
             * @param s Editable object in which the text has been changed
             */
            @Override
            public void afterTextChanged(Editable s) {
                // Splitting the string everytime the "§" symbol is encountered
                String[] data = activityToFragment.getText().toString().split("§");
                // Setting title
                TextView title = (TextView) view.findViewById(R.id.qr_title);
                title.setText(data[0]);
                // Setting description
                TextView qrResult = (TextView) view.findViewById(R.id.qr_result);
                qrResult.setText(data[1]);

                // Layout containing Play and Pause Buttons and background music TextView
                LinearLayout audioLayout = (LinearLayout) view.findViewById(R.id.linearLayout);

                // If there is an audio URL
                if (data.length >= 3 && data[2].contains(".mp3")) {
                    audioLayout.setVisibility(View.VISIBLE);

                    try {
                        // Setting the data source as the audio URL
                        mediaPlayer.setDataSource(data[2]);
                        mediaPlayer.prepare();
                        // Turning down the volume for the music background
                        mediaPlayer.setVolume(0.1f, 0.1f);
                    } catch (Exception e) {
                        // Exception already handled
                        e.printStackTrace();
                    }

                    // Setting the button that will play or pause the music background
                    final Button playPauseButton = (Button) view.findViewById(R.id.play_pause);
                    playPauseButton.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            // If the mediaplayer isn't playing and the button has been clicked
                            if (!mediaPlayer.isPlaying()) {
                                // Change the button icon to the pause icon and start playing
                                playPauseButton.setBackground(view.getResources()
                                        .getDrawable(R.drawable.pause));
                                mediaPlayer.start();
                            } else {
                                // If the mediaplayer is playing and the button has been clicked
                                // change the button icon to the play button and pause the music
                                playPauseButton.setBackground(view.getResources()
                                        .getDrawable(R.drawable.play));
                                mediaPlayer.pause();
                            }
                        }
                    });

                    // Setting the button that will stop the music background
                    Button stopButton = (Button) view.findViewById(R.id.stop);
                    stopButton.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            // Pause the music and go to the beginning of the audio file
                            mediaPlayer.pause();
                            mediaPlayer.seekTo(0);
                            // Set the playPauseButton icon to the play icon
                            playPauseButton.setBackground(view.getResources()
                                    .getDrawable(R.drawable.play));
                        }
                    });

                    // If the audio file has finished playing
                    mediaPlayer.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {
                        @Override
                        public void onCompletion(MediaPlayer mp) {
                            // Set the playPauseButton icon to the play icon
                            playPauseButton.setBackground(view.getResources()
                                    .getDrawable(R.drawable.play));
                        }
                    });
                }
                else {
                    // If there isn't an audio URL hide the corresponding TextView and Buttons
                    audioLayout.setVisibility(View.INVISIBLE);
                }

                // View containing video player
                final VideoView videoView = (VideoView) view.findViewById(R.id.video_view);

                // If there is a video URL
                if (data.length == 4 || (data.length == 3 && data[2].contains(".mp4"))) {
                    // Setting the view that will contain the video
                    videoView.setVisibility(View.VISIBLE);

                    // Setting the video resource to the video URL
                    if (data.length == 4)
                        videoView.setVideoURI(Uri.parse(data[3]));
                    else
                        videoView.setVideoURI(Uri.parse(data[2]));

                    // The play/pause function will be triggered by clicking the videoView
                    videoView.setOnTouchListener(new View.OnTouchListener() {
                        @Override
                        public boolean onTouch(View v, MotionEvent event) {
                            // If the video is playing the video will be paused
                            if (videoView.isPlaying()) {
                                videoView.pause();
                            } else {
                                // If the video is not playing the video will be played
                                videoView.start();
                            }

                            return false;
                        }
                    });
                }
                else {
                    // If there isn't a video URL set the Video View as invisible
                    videoView.setVisibility(View.INVISIBLE);
                }
            }
        });

        // Setting the button that will start the Text To Speech
        final Button speakButton = (Button) view.findViewById(R.id.speak_button);

        // Setting the Text To Speech language when initialized
        textToSpeech = new TextToSpeech(getActivity(), new TextToSpeech.OnInitListener() {
            @Override
            public void onInit(int status) {
                // If there are errors don't show the speakButton, otherwise set the italian
                // language as the Text To Speech language
                if (status == TextToSpeech.SUCCESS)
                    resultTextToSpeech = textToSpeech.setLanguage(Locale.ITALIAN);
                else
                    speakButton.setVisibility(View.INVISIBLE);
            }
        });


        speakButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // If the button is clicked and there are no errors
                if (resultTextToSpeech != TextToSpeech.LANG_MISSING_DATA &&
                        resultTextToSpeech != TextToSpeech.LANG_NOT_SUPPORTED) {
                    // Read the description in the qrResult TextView
                    TextView qrResult = (TextView) view.findViewById(R.id.qr_result);
                    String text = qrResult.getText().toString();
                    textToSpeech.speak(text, TextToSpeech.QUEUE_FLUSH, null);
                } else
                    // Otherwise don't show the speak button
                    speakButton.setVisibility(View.INVISIBLE);
            }
        });

        return view;
    }


    /**
     * When the app is no longer visible
     */
    @Override
    public void onPause() {
        super.onPause();

        // Stop the Text To Speech from speaking if it's speaking
        if (textToSpeech.isSpeaking())
            textToSpeech.stop();

        // Stop the mediaplayer from playing the audio if it's playing and change the
        // playPauseButton icon
        if (mediaPlayer.isPlaying()) {
            mediaPlayer.pause();
            Button playPauseButton = (Button) view.findViewById(R.id.play_pause);
            playPauseButton.setBackground(view.getResources().getDrawable(R.drawable.play));
        }
    }

    /**
     * When the app has been stopped (e.g.: home button pressed)
     */
    @Override
    public void onStop() {
        super.onStop();

        // Stop the Text To Speech from speaking if it's speaking
        if (textToSpeech.isSpeaking())
            textToSpeech.stop();

        // Stop the mediaplayer from playing the audio if it's playing and change the
        // playPauseButton icon
        if (mediaPlayer.isPlaying()) {
            mediaPlayer.pause();
            Button playPauseButton = (Button) view.findViewById(R.id.play_pause);
            playPauseButton.setBackground(view.getResources().getDrawable(R.drawable.play));
        }
    }


    /**
     * When the app is closed the resources will be released
     */
    @Override
    public void onDestroy() {
        super.onDestroy();
        textToSpeech.shutdown();
        mediaPlayer.release();
    }
}