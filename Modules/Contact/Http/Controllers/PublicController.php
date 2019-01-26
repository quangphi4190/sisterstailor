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
        return view('contact::frontend.contact',compact('countCart'));
    }

    public function postContact(CreateContactRequest $request){
        $this->contact->create($request->all());
        alert()->success('Thanks For Contacting', 'Successfully')->autoClose(2000);
        return redirect('/');
    }
}