<?php namespace Modules\Products\Http\Controllers;


use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Products\Repositories\CategoriesRepository;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Products\Entities\Products;
use Modules\Products\Entities\ProductsTranslation;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
class PublicController extends BasePublicController {
    private $products, $categories;

    /**
     * @var FooterSliderRepository
     *

    /**
     * PublicController constructor.
     *
     * @param RoomRepository $offerRepository
     * @param RoomCatRepository $offerCatRepository
     */
    public function __construct(ProductsRepository $products, CategoriesRepository $categories ) {
        parent::__construct();
        $this->products        = $products;
        $this->categories = $categories;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view( 'products::frontend.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show( $slug ) {
        $event = Event::where('slug', $slug)->first();
        $events = $this->events->all();
        $price = $price = Dining::where('slug', 'nem')->first();

        return view( 'event::event.defail-index', compact( 'event', 'slug','events','price'));

    }
}
