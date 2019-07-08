<?php
/**
 * Created by PhpStorm.
 * User: dmytro
 * Date: 7/5/19
 * Time: 1:30 PM
 */

namespace Tests\Feature;

use App\Models\Base\Projects\Project;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    const PATH_DOC = '/docs/api-docs.json';

    public function testCreate()
    {
        $responseDoc = $this->getResponse('/project/create', 'post', 200);

        //test validation
        $response = $this->post(route('api.project.create'));
        $response->assertStatus(422);

        $data = factory(Project::class)->make()->toArray();
        $response = $this->post(route('api.project.create'), $data);


        $response->assertStatus(200);
        $response->assertJsonStructure($responseDoc);
    }

    public function testUpdate()
    {
        $responseDoc = $this->getResponse('/project/update', 'post', 200);

        //test validation
        $response = $this->post(route('api.project.update'));
        $response->assertStatus(422);

        $data = factory(Project::class)->make()->toArray();
        $response = $this->post(route('api.project.create'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure($responseDoc);
    }

    public function testGet()
    {
        $responseDoc = $this->getResponse('/project/search/{id}', 'get', 200);

        $projectId = factory(Project::class)->create()->id;
        $response = $this->get(route('api.project.get', ['id' => $projectId]));


        $response->assertStatus(200);
        $response->assertJsonStructure($responseDoc);

    }


    public function testGets()
    {
        factory(Project::class)->create();
        $responseDoc = $this->getResponse('/project/all', 'get', 200);


        $response = $this->get(route('api.project.gets'));
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