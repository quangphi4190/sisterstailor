<?php

namespace Modules\Contact\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Http\Requests\UpdateContactRequest;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ContactController extends AdminBaseController
{
    /**
     * @var ContactRepository
     */
    private $contact;

    public function __construct(ContactRepository $contact)
    {
        parent::__construct();

        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$contacts = $this->contact->all();

        return view('contact::admin.contacts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('contact::admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateContactRequest $request
     * @return Response
     */
    public function store(CreateContactRequest $request)
    {
        $this->contact->create($request->all());

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('contact::contacts.title.contacts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        return view('contact::admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Contact $contact
     * @param  UpdateContactRequest $request
     * @return Response
     */
    public function update(Contact $contact, UpdateContactRequest $request)
    {
        $this->contact->update($contact, $request->all());

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('contact::contacts.title.contacts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        $this->contact->destroy($contact);

        return redirect()->route('admin.contact.contact.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('contact::contacts.title.contacts')]));
    }
}
