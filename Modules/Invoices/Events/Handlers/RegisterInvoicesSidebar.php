<?php

namespace Modules\Invoices\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterInvoicesSidebar implements \Maatwebsite\Sidebar\SidebarExtender
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
            $group->item('Bán hàng', function (Item $item) {
                $item->icon('fa fa-list-ul');
                $item->weight(0);
                $item->authorize(
                     /* append */
                );
                $item->item('Tạo mới đơn hàng', function (Item $item) {
                    $item->icon('fa fa-plus');
                    $item->weight(0);

                    $item->route('admin.invoices.invoice.create');
                    $item->authorize(
                        $this->auth->hasAccess('invoices.invoices.create')
                    );
                });
                $item->item('Danh sách đơn hàng', function (Item $item) {
                    $item->icon('fa fa-list-ul');
                    $item->weight(1);

                    $item->route('admin.invoices.invoice.index');
                    $item->authorize(
                        $this->auth->hasAccess('invoices.invoices.index')
                    );
                });
// append

            });
        });

        return $menu;
    }
}
