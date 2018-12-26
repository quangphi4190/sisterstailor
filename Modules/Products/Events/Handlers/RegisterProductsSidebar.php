<?php

namespace Modules\Products\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterProductsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item(trans('products::products.title.products'), function (Item $item) {
                $item->icon('fa fa-product-hunt');
                $item->weight(1);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('products::products.title.products'), function (Item $item) {
                    $item->icon('fa fa-product-hunt');
                    $item->weight(0);
                    $item->append('admin.products.products.create');
                    $item->route('admin.products.products.index');
                    $item->authorize(
                        $this->auth->hasAccess('products.products.index')
                    );
                });
// append


            });
        });

        return $menu;
    }
}
