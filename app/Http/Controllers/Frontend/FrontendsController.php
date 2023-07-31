<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Contact;
use App\Model\Promotion;
use App\Model\Review;
use App\Model\Article;
use App\Model\Tour;
use App\Model\TourType;

class FrontendsController extends Controller
{
    public function index(){
        $promotions = Promotion::where('status','เปิด')->get();
        $reviews = Review::where('status','เปิด')->get();
        $articles = Article::where('status','เปิด')->get();
        $tours = Tour::where('status','เปิด')->get();
        return view('frontend/index')->with('reviews',$reviews)
                                     ->with('articles',$articles)
                                     ->with('promotions',$promotions)
                                     ->with('tours',$tours);
    }

    public function contactUs() {
        $contact_id = Contact::value('id');
        $contact = Contact::findOrFail($contact_id);
        return view('frontend/contact-us/page-contact')->with('contact',$contact);
    }

    public function aboutUs() {
        return view('frontend/about-us/page-about');
    }

    public function promotion() {
        $promotions = Promotion::where('status','เปิด')->get();
        return view('frontend/promotion/promotion')->with('promotions',$promotions);
    }

    public function promotionInformation($id) {
        $promotion = Promotion::findOrFail($id);
        return view('frontend/promotion/promotion-information')->with('promotion',$promotion);
    }

    public function articleReview() {
        $reviews = Review::where('status','เปิด')->get();
        $articles = Article::where('status','เปิด')->get();
        return view('frontend/article-review/article-review')->with('reviews',$reviews)
                                                             ->with('articles',$articles);
    }

    public function articleInformation($id) {
        $article = Article::findOrFail($id);
        return view('frontend/article-review/article-information')->with('article',$article);
    }

    public function packageTour($type) {
        $type_id = TourType::where('type_eng',$type)->value('id');
        $tours = Tour::where('type_id',$type_id)->where('status',"เปิด")->get();
        return view('frontend/tour/tour-package')->with('tours',$tours)
                                                 ->with('type',$type);
    }

    public function packageTourInformation($id) {
        $tour = Tour::findOrFail($id);
        return view('frontend/tour/tour-package-information')->with('tour',$tour);
    }
}
