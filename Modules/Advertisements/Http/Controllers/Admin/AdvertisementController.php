<?php

namespace Modules\Advertisements\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Advertisements\Entities\Advertisement;
use Modules\Advertisements\Http\Requests\CreateAdvertisementRequest;
use Modules\Advertisements\Http\Requests\UpdateAdvertisementRequest;
use Modules\Advertisements\Repositories\AdvertisementRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class AdvertisementController extends AdminBaseController
{
    /**
     * @var AdvertisementRepository
     */
    private $advertisement;

    public function __construct(AdvertisementRepository $advertisement)
    {
        parent::__construct();

        $this->advertisement = $advertisement;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $advertisements = $this->advertisement->all();

        return view('advertisements::admin.advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $advertisement = new Advertisement();
        return view('advertisements::admin.advertisements.create',compact('advertisement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAdvertisementRequest $request
     * @return Response
     */
    public function store(CreateAdvertisementRequest $request)
    {
        $this->advertisement->create($request->all());

        return redirect()->route('admin.advertisements.advertisement.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('advertisements::advertisements.title.advertisements')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Advertisement $advertisement
     * @return Response
     */
    public function edit(Advertisement $advertisement)
    {
        $status = $advertisement->status;
        $position = $advertisement->position;
        return view('advertisements::admin.advertisements.edit', compact('advertisement','position','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Advertisement $advertisement
     * @param  UpdateAdvertisementRequest $request
     * @return Response
     */
    public function update(Advertisement $advertisement, UpdateAdvertisementRequest $request)
    {
        $this->advertisement->update($advertisement, $request->all());

        return redirect()->route('admin.advertisements.advertisement.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('advertisements::advertisements.title.advertisements')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Advertisement $advertisement
     * @return Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $this->advertisement->destroy($advertisement);

        return redirect()->route('admin.advertisements.advertisement.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('advertisements::advertisements.title.advertisements')]));
    }
}
