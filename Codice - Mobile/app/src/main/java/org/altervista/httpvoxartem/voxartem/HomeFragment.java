package org.altervista.httpvoxartem.voxartem;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

/**
 * Fragment to show the "home page"
 */
public class HomeFragment extends Fragment {


    /**
     * Empty default constructor
     */
    public HomeFragment() { }


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
        return inflater.inflate(R.layout.fragment_home, container, false);
    }
}