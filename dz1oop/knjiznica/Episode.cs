using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace knjiznica
{
    public class Episode
    {
        public int viewers;
        public double sumOfRatings;
        public double maxRating;

        public Episode() { viewers = 0; sumOfRatings = 0; maxRating = 0; }

        public Episode(int viewerss, double sumOfRatingss, double maxRatingg)
        {
            viewers = viewerss;
            sumOfRatings = sumOfRatingss;
            if (maxRatingg <= 10 && maxRatingg >= 0)
            {
                maxRating = maxRatingg;
            }
            else
            {
                throw new ArgumentOutOfRangeException("maxRating", "Rating must be between 0 and 10.");
            }
        }


        public void AddView(double score) { viewers++; sumOfRatings += score; if (score > maxRating) maxRating = score; }

        public string GetMaxScore() { return "" + maxRating; }

        public double GetAverageScore() { return sumOfRatings / viewers; }
                     
        public string GetViewerCount() { return "" + viewers; }

    }
}
