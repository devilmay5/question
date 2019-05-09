<?php

namespace App\Admin\Controllers;

use App\Movie;
use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;

use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Admin\Extensions\ExcelExpoter;
use Encore\Admin\Facades\Admin;


class MovieController extends Controller
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
//        return $content
//            ->header('Index')
//            ->description('description')
//            ->body($this->grid());
        $grid = $this->grid();
        $grid->column('id')->sortable();

        $grid->column('title', '标题')->display(function ($title) {
            return "<h4>$title</h4>";
        });

//        $grid->name()->display(function ($name) {
//            return "<span class='label'>$name</span>";
//        });


        // 添加不存在的字段
        $grid->column('column_not_in_table')->display(function () {
            return 'blablabla....';
        });


        $grid->column('director')->display(function ($userId) {
            $res = User::find($userId);
            if ($res) {
                return $res->name;
            } else {
                return "沒名字傻逼";
            }

        });
        // 第四列显示为describe字段
        $grid->describe();

        // 第五列显示为rate字段
        $grid->rate();

        // 第六列显示released字段，通过display($callback)方法来格式化显示输出
        $grid->released('上映?')->display(function ($released) {
            return $released ? '是' : '否';
        });

// 下面为三个时间字段的列显示
        $grid->release_at();
        $grid->created_at();
        $grid->updated_at();

        // filter($callback)方法用来设置表格的简单搜索框
        $grid->filter(function ($filter) {

            // 设置created_at字段的范围查询
//            $filter->between('created_at', 'Created Time')->datetime();
//            $filter->like('title', '文章标题');
//            $filter->scope('title', '文章标题')->where('title', 'like','%3%');

            $filter->day('created_at', "wjjsb");
            $filter->equal('created_at')->date();

            $filter->equal('rate', 'wjjsb2')->email();

            $filter->scope('male')->where('released', '1');

// 多条件查询
            $filter->scope('new', '最近修改')
                ->whereDate('created_at', date('Y-m-d'))
                ->orWhere('updated_at', date('Y-m-d'));

// 关联关系查询
            $filter->scope('address')->whereHas('profile', function ($query) {
                $query->whereNotNull('address');
            });

            $filter->scope('trashed', '被软删除的数据')->onlyTrashed();

            $filter->where(function ($query) {
                switch ($this->input) {
                    case 'yes':
                        // custom complex query if the 'yes' option is selected
                        $query->has('somerelationship');
                        break;
                    case 'no':
                        $query->doesntHave('somerelationship');
                        break;
                }
            }, 'Label of the field', 'name_for_url_shortcut')->radio([
                '' => 'All',
                'yes' => 'Only with relationship',
                'no' => 'Only without relationship',
            ]);

            $filter->expand();
        });


        $grid->model()->orderBy('id', 'desc');

        // 默认为每页20条
        $grid->paginate(20);

        // $grid->expandFilter();
        $grid->actions(function ($actions) {

            // 当前行的数据数组
//            $sb1 = $actions->row;
//
//            // 获取当前行主键值
//            $actions->getKey();

            // append一个操作
//            $actions->modal('最新评论', function () {
//
//                $comments = Movie::query()->comments()->take(10)->get()->map(function ($comment) {
//                    return $comment->only(['id', 'content', 'created_at']);
//                });
//
//                return new Table(['ID', '内容', '发布时间'], $comments->toArray());
//            })->append('查看详情');

            // prepend一个操作
            //    $actions->prepend('<a href=""><i class="fa fa-paper-plane"></i></a>');

        });

        $grid->header(function ($query) {
            return 'header';
        });

        $grid->footer(function ($query) {
            return 'footer';
        });

        $grid->exporter(new ExcelExpoter());


//        $grid1 = Admin::form(Movie::class, function(Form $form){
//
//            // 显示记录id
//            $form->display('id', 'ID');
//
//            // 添加text类型的input框
//            $form->text('title', '电影标题');
//
//            $directors = [
//                'John'  => 1,
//                'Smith' => 2,
//                'Kate'  => 3,
//            ];
//
//            $form->select('director', '导演')->options($directors);
//
//            // 添加describe的textarea输入框
//            $form->textarea('describe', '简介');
//
//            // 数字输入框
//            $form->number('rate', '打分');
//
//            // 添加开关操作
//            $form->switch('released', '发布？');
//
//            // 添加日期时间选择框
//          //  $form->dateTime('release_at', '发布时间');
//
//            // 两个时间显示
//            $form->display('created_at', '创建时间');
//            $form->display('updated_at', '修改时间');
//        });


        return $content->body($grid);
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

//    public function update($id)
//    {
//
//        $form = $this->form();
//
//
//        //保存前回调
//        $form->saving(function (Form $form)
//            //...
//            {
//            //throw new \Exception("错啦错啦");
//        });
//
//
//        $form->saved(function (Form $form) {
//            //...
////            $file = fopen("../storage/logs/show_zhangshuwei1.log","w+");
////            fputs($file,$form->title);
////            fclose($file);
//        //    var_dump($form);exit;
//
//         //   return response('怎么就不出发呢');
//        });
//
//        $res = $form->update($id);
//        return $res;
//    }

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
        $grid = new Grid(new Movie);


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
        $show = new Show(Movie::findOrFail($id));


        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Movie);
        $form->text('title', '电影标题')->help('help...');

        $form->display('id', 'ID');

        $directors = [
            '1' => 1,
            '2' => 2,
            '3' => 3,
        ];

        $form->select('director', '导演')->options($directors);
        // 添加describe的textarea输入框
        $form->textarea('describe', '简介');

        // 数字输入框
        $form->number('rate', '打分');

        // 添加开关操作
        $form->switch('released', '发布？');

        // 添加日期时间选择框
        $form->datetime('release_at', '发布时间');

        // 两个时间显示
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');
        $form->saved(function (Form $form) {

           // return response('怎么就不出发呢');
        });

        return $form;
    }
}
