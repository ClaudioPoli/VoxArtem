package org.altervista.httpvoxartem.voxartem;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapView;
import com.google.android.gms.maps.MapsInitializer;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

/**
 * Fragment to show the map of the museum; it can send an intent to a navigator app
 */
public class FindusFragment extends Fragment {

    MapView mapView;
    GoogleMap googleMap;


    /**
     * Empty default constructor
     */
    public FindusFragment() { }


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
        View view = inflater.inflate(R.layout.fragment_findus, container, false);

        // Initializing the map
        MapsInitializer.initialize(view.getContext());

        // Getting the map from the layout
        mapView = (MapView) view.findViewById(R.id.map_view);
        // Creating the map; if there is a previous saved state, then that map will be built
        // from it
        mapView.onCreate(savedInstanceState);
        // Showing the map
        mapView.onResume();

        // The only way to set a GoogleMap object is by using the getMapAsync(OnMapReadyCallback
        // callback) method, creating an anonimous class that implements the OnMapReadyCallback
        // interface, overriding the abstract method onMapReady(GoogleMap googleMap)
        mapView.getMapAsync(new OnMapReadyCallback() {
            @Override
            public void onMapReady(GoogleMap mMap) {
                googleMap = mMap;

                // Setting a marker to the museum location
                LatLng museum = new LatLng(41.311562, 19.440327);
                googleMap.addMarker(new MarkerOptions().position(museum).title("Museo di Durazzo")
                        .snippet("Albania"));

                // Setting the zoom to the marker
                CameraPosition cameraPosition = new CameraPosition.Builder().target(museum)
                        .zoom(16).build();
                googleMap.animateCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));

                // Buildings and streets will be shown
                googleMap.setTrafficEnabled(true);
                googleMap.setBuildingsEnabled(true);
            }
        });

        // If the navigateButton is clicked, an intent will be thrown to a navigator app, with
        // the starting point setted to the current position and the destination point setted to
        // the museum location
        Button navigateButton = (Button) view.findViewById(R.id.navigate_button);
        navigateButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // The saddr parameter is not used, so that the starting point is going to be
                // setted to the current position
                Intent intent = new Intent(android.content.Intent.ACTION_VIEW,
                        Uri.parse("http://maps.google.com/maps?daddr=ArchaeologicalMuseumDurres"));
                startActivity(intent);
            }
        });

        return view;
    }
}