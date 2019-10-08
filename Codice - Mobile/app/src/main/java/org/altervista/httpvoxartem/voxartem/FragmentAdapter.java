package org.altervista.httpvoxartem.voxartem;

import android.content.Context;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

/**
 * FragmentAdapter that will handle the 3 fragments
 */
class FragmentAdapter extends FragmentPagerAdapter {

    private Context mContext;


    /**
     * Constructor that will set the context
     *
     * @param context context of the adapter
     * @param manager FragmentManager that will be used
     */
    FragmentAdapter(Context context, FragmentManager manager) {
        super(manager);
        mContext = context;
    }


    /**
     * Returns the fragment in the corresponding index; the fragments are ordered from left to
     * right
     *
     * @param position fragment index
     * @return fragment at the specified index
     */
    @Override
    public Fragment getItem(int position) {
        switch (position) {
            case 0:
                return new HomeFragment();
            case 1:
                return new QRFragment();
            case 2:
                return new FindusFragment();
            // In unexpected cases the home fragment will be shown
            default:
                return new HomeFragment();
        }
    }


    /**
     * Returns the number of fragments
     *
     * @return number of fragments
     */
    @Override
    public int getCount() {
        return 3;
    }


    /**
     * Return the title of the fragment in the specified index
     *
     * @param position fragment index
     * @return title of the fragment in the specified index
     */
    @Override
    public CharSequence getPageTitle(int position) {
        switch (position) {
            case 0:
                return mContext.getString(R.string.home_fragment);
            case 1:
                return mContext.getString(R.string.qr_fragment);
            case 2:
                return mContext.getString(R.string.findus_fragment);
            // In unexpected cases the home fragment will be shown, so it will be shown the
            // "Home" title
            default:
                return mContext.getString(R.string.home_fragment);
        }
    }
}