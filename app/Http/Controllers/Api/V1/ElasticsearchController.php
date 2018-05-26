<?php
/**
 * Created by huaixiu.zhen@gmail.com
 * http://litblc.com
 * User: huaixiu.zhen
 * Date: 2018/5/26
 * Time: 19:33
 */

namespace App\Http\Controllers\Api\V1;

use Elasticsearch\ClientBuilder;

class ElasticsearchController
{
    private static $esClient;

    /**
     * 初始化连接
     */
    public function __construct()
    {
        if (!self::$esClient) {
            self::$esClient = ClientBuilder::create()
                ->setHosts([env('ELASTICSEARCH_HOST_NODE_1')])
                ->build();
        }
    }


    /**
     * 创建一个索引（index,类似于创建一个库）
     * 6.0版本以后一个index只能有一个type
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexCreate($index)
    {
        $params = [
            'index' => $index,
            'body' => [
                'settings' => [
                    'number_of_shards' => env('NUMBER_OF_SHARDS', 5),      // 分片 默认5
                    'number_of_replicas' => env('NUMBER_OF_REPLICAS', 1)   // 副本、备份 默认1
                ]
            ]
        ];
        $response = self::$esClient->indices()->create($params);

        return response()->json($response);
    }


    /**
     * 删除一个索引（index,类似于删除一个库）
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexDelete($index)
    {
        $params = [
            'index' => $index
        ];
        $response =  self::$esClient->indices()->delete($params);

        return response()->json($response);
    }


    /**
     * 创建一条数据（索引一个文档）
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index string
     * @param $type string
     * @param $id int
     * @param $body array('key' => 'val')
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDoc($index, $type, $id, $body)
    {
        /* TODO
        array_push($body, ['mappings' => [
            '_default_' => [
                'dynamic_templates' => [
                    [
                        'strings' => [
                            'match_mapping_type' => 'string',
                            'mapping' => [
                                'type' => 'text',
                                'analyzer' => 'ik_smart',
                                'fields' => [
                                    'keyword' => [
                                        'type' => 'keyword'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]]);
        */
        $params = [
            'index' => $index,
            'type' => $type,
            'id' => $id,
            'body' => $body,

        ];
        $response = self::$esClient->index($params);

        return response()->json($response);
    }


    /**
     * 获取一个文档（对应上面createDoc）
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index string
     * @param $type string
     * @param $id int
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDoc($index, $type, $id)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'id' => $id
        ];
        $response = self::$esClient->get($params);

        return response()->json($response);
    }


    /**
     * 搜索文档 doc
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index string
     * @param $type string
     * @param $query string
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($index, $type, $query)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'body' => [
                'query' => [
// 单字段
//                    'match' => [
//                        'key1' => $query
//                    ]

// 多字段
                    'multi_match' => [
                        'query' => $query,
                        "type" => "best_fields",
                        'operator' => 'or',
                        'fields' => ['name', 'title', 'content']  // TODO 根据数据表字段，准确说是存入es的字段进行修改
                    ]
                ]
            ]
        ];
        $response = self::$esClient->search($params);

        return response()->json($response['hits']);
    }


    /**
     * 删除一条记录（文档） doc
     * Author huaixiu.zhen@gmail.com
     * http://litblc.com
     * @param $index
     * @param $type
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($index, $type, $id)
    {
        $params = [
            'index' => $index,
            'type' => $type,
            'id' => $id
        ];
        $response = self::$esClient->delete($params);

        return response()->json($response);
    }
}