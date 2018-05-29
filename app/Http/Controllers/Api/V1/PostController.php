<?php

namespace App\Http\Controllers\Api\V1;

use App\Model\Post;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    /**
     * 根据id返回用户信息
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $id
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    private function getUserInfoById($id)
    {
        $user = User::find($id);
        if ($user) {
            $userInfo['username'] = $user->name;
            $userInfo['avatar'] = $user->avatar;
            $userInfo['bio'] = $user->bio;
        } else {
            $userInfo['username'] = trans('front.user_destory_name');
            $userInfo['avatar'] = asset('/static/defaultAvatar.jpg');
            $userInfo['bio'] = '';
        }

        return $userInfo;
    }


    /**
     * 文章首页数据展示，可以不登录
     * Author huaixiu.zhen
     * http://litblc.com
     * @param Request $request  page sortby  non - must
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllPosts(Request $request)
    {
        if ($request->get('sortby') && $request->get('sortby') == 'new') {
            $posts = Post::where('deleted', 'none')->orderBy('created_at', 'desc')->paginate(env('PER_PAGE', 5));
        } else {
            $posts = Post::where('deleted', 'none')->orderBy('like_num', 'desc')->paginate(env('PER_PAGE', 5));
        }
        foreach ($posts as $post) {
            $post->userinfo = $this->getUserInfoById($post->user_id);
        }
        return response()->json([
            'status_code' => 200,
            'data' => $posts
        ]);
    }

    /**
     * 根据uuid获取文章详情
     * Author huaixiu.zhen
     * http://litblc.com
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostById($uuid)
    {
        $post = Post::where('uuid', $uuid)->first();
        if ($post) {
            $post->userinfo = $this->getUserInfoById($post->user_id);
        }
        return response()->json([
            'status_code' => 200,
            'data' => $post
        ]);
    }

    /**
     * 创建post,同一个人三分钟创建一个
     * Author huaixiu.zhen
     * http://litblc.com
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:64',
            'content' => 'required|max:500',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 400,
                'message' => $validator->errors()->first()
            ]);
        } else {
            if ($this->isRedisExists('post:user:'.Auth::id())) {
                return response()->json([
                    'status_code' => 422,
                    'message' => '您的操作太频繁，距离下一次请求时间为：'.$this->getRedisTtl('post:user:'.Auth::id()).'s'
                ]);
            } else {
                $this->setRedis('post:user:'.Auth::id(), 'create', 'EX', 180);
                $uuid = $this->uuid('post-');
                $post = Post::create([
                    'uuid' => $uuid,
                    'user_id' => Auth::id(),
                    'title' => $request->get('title'),
                    'content' => $request->get('content'),
                ]);

                if ($post) {
                    $post->userinfo = $this->getUserInfoById($post->user_id);

                    return response()->json([
                        'status_code' => 201,
                        'data' => $post
                    ]);
                }
            }
        }
    }


    // 发送post 和隐藏域_method=put即可
    public function updatePost(Request $request, $uuid)
    {

    }

}
