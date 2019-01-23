<?php namespace Modules\Contact\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Request;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Products\Repositories\ProductsRepository;
use Modules\Products\Entities\Products;
use Modules\Products\Entities\ProductsTranslation;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Illuminate\Support\Facades\Input;
use Modules\Category\Entities\Category;
use Modules\Contact\Entities\Contact;

class PublicController extends BasePublicController
{
    private $contact;

    /**
     * @var FooterSliderRepository
     *
     *
     * /**
     * PublicController constructor.
     *
     * @param RoomRepository $offerRepository
     * @param RoomCatRepository $offerCatRepository
     */
    public function __construct(ContactRepository $contact)
    {
        parent::__construct();
        $this->contact = $contact;
    }

    public function index(){
        $countCart =0;
        $othercategory = Category::whereNotIn('id',[1,2])->where('parent_id',Null)->get();
        $nameMen = Category::where('parent_id','1')->get();
        $nameWomen = Category::where('parent_id','2')->get();
        $category = Category::where('id','1')->orwhere('id','2')->get();
        return view('contact::frontend.contact',compact('countCart','othercategory','nameMen','nameWomen','category'));
    }

    public function postContact(CreateContactRequest $request){
        $this->contact->create($request->all());
        alert()->success('Góp Ý Thành Công', 'Successfully')->autoClose(100000);
        return redirect('/');
    }
}