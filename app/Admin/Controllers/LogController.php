<?php

namespace App\Admin\Controllers;

use App\Runtime;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class LogController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('运行日志')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Runtime);

        $grid->id('Id');
        $grid->name('设备名称');
        $grid->ip('Ip');
        $grid->status('状态');
        $grid->cpu('CPU');
        $grid->mem('内存');
        $grid->created_at('创建时间');
        $grid->updated_at('更新时间');

        $grid->disableActions();
        $grid->disableCreateButton();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Runtime::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->ip('Ip');
        $show->status('Status');
        $show->cpu('Cpu');
        $show->mem('Mem');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Runtime);

        $form->text('name', 'Name');
        $form->ip('ip', 'Ip');
        $form->number('status', 'Status')->default(1);
        $form->number('cpu', 'Cpu')->default(10);
        $form->number('mem', 'Mem')->default(10);

        return $form;
    }
}
