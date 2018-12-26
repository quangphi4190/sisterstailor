<?php

namespace Modules\Orders\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterOrdersSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
        $menu->group('Website bán hàng', function (Group $group) {
            $group->item('Đơn đặt hàng', function (Item $item) {
                $item->icon('fa fa-list-ol');
                $item->weight(0);
                $item->authorize(
                     /* append */
                );
                $item->item('Đơn đặt hàng', function (Item $item) {
                    $item->icon('fa fa-list-ol');
                    $item->weight(0);
                    $item->append('admin.orders.order.create');
                    $item->route('admin.orders.order.index');
                    $item->authorize(
                        $this->auth->hasAccess('orders.orders.index')
                    );
                });
                // $item->item(trans('orders::order_details.title.order_details'), function (Item $item) {
                //     $item->icon('fa fa-copy');
                //     $item->weight(0);
                //     $item->append('admin.orders.order_details.create');
                //     $item->route('admin.orders.order_details.index');
                //     $item->authorize(
                //         $this->auth->hasAccess('orders.order_details.index')
                //     );
                // });
// append


            });
        });

        return $menu;
    }
}
