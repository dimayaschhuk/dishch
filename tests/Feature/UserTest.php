<?php
/**
 * Created by PhpStorm.
 * User: dmytro
 * Date: 7/5/19
 * Time: 1:30 PM
 */

namespace Tests\Feature;

use App\Models\Base\Users\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    const PATH_DOC = '/docs/api-docs.json';

    public function testCreate()
    {
        $responseDoc = $this->getResponse('/user/create', 'post', 200);


        //test validation
        $response = $this->post(route('api.user.create'));
        $response->assertStatus(422);


        $data = factory(User::class)->make()->toArray();
        $data['password'] = 'password';
        $response = $this->post(route('api.user.create'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure($responseDoc);
    }

    public function testUpdate()
    {
        $responseDoc = $this->getResponse('/user/update', 'post', 200);

        //test validation
        $response = $this->post(route('api.user.update'));
        $response->assertStatus(422);

        $data = factory(User::class)->make()->toArray();
        $data['id'] = factory(User::class)->create()->id;
        $response = $this->post(route('api.user.update'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure($responseDoc);
    }

    public function testGet()
    {
        $responseDoc = $this->getResponse('/user/search/{id}', 'get', 200);

        $userId = factory(User::class)->create()->id;
        $response = $this->get(route('api.user.get', ['id' => $userId]));


        $response->assertStatus(200);
        $response->assertJsonStructure($responseDoc);

    }


    public function testGets()
    {
        factory(User::class)->create();
        $responseDoc = $this->getResponse('/user/all', 'get', 200);

        $response = $this->get(route('api.user.gets'));
        $response->assertJsonStructure($responseDoc);
        $response->assertStatus(200);



    }


    public function getResponse($path, $method, $code)
    {

        $data = [];
        $responseDOC = $this->get(self::PATH_DOC)->decodeResponseJson();
        $definition = $responseDOC['paths'][$path][$method]['responses'][$code]['schema'];

        if (array_key_exists('type', $definition)) {
            $definition = $definition['items']['$ref'];
            $definitions = explode("/", $definition);
            $properties = $responseDOC[$definitions[1]][$definitions[2]]['properties'];
            $propertyKeys = [];
            foreach ($properties as $key => $property) {
                $propertyKeys[] = $key;
            }
            $data = [0 => $propertyKeys];
        } else {

            $definition = $definition['$ref'];
            $definitions = explode("/", $definition);

            $properties = $responseDOC[$definitions[1]][$definitions[2]]['properties'];

            foreach ($properties as $key => $property) {
                $data[] = $key;
            }

        }

        $response = [
            'status',
            'code',
            'data' => $data,
        ];

        return $response;

    }


}