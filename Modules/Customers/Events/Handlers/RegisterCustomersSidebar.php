<?php

namespace Modules\Customers\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterCustomersSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group('Quản lý bán hàng', function (Group $group) {
            $group->item(trans('customers::customers.title.customers'), function (Item $item) {
                $item->icon('fa fa-user');
                $item->weight(1);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('customers::customers.list resource'), function (Item $item) {
                    $item->icon('fa fa-user');
                    $item->weight(0);
                    $item->append('admin.customers.customer.create');
                    $item->route('admin.customers.customer.index');
                    $item->authorize(
                        $this->auth->hasAccess('customers.customers.index')
                    );
                });
// append

            });


        });

        return $menu;
    }
}
