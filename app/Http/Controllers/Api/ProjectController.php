<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\BaseRequest;
use App\Http\Requests\Api\Projects\CreateProjectRequest;
use App\Http\Requests\Api\Projects\GetProjectRequest;
use App\Http\Requests\Api\Projects\UpdateProjectRequest;
use App\Models\Api\Projects\Project;


class ProjectController extends ApiController
{
    /**
     * @SWG\Get(
     *     path="/project/search/{id}",
     *     summary="дістати один проект по id",
     *     tags={"Project"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="об'єктів Project",
     *     @SWG\Schema(ref="#/definitions/Project"),
     *     ),
     * )
     */
    public function getProject($projectId)
    {
        $project = Project::findOrFail($projectId);
        $this->setData($project);

        return $this->getResponse();
    }


    /**
     * @SWG\Get(
     *     path="/project/all",
     *     tags={"Project"},
     *     summary="дістати всі проекти",
     *
     *     @SWG\Response(
     *          response="200",
     *          description="",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Project")
     *          ),
     *     )
     * )
     */
    public function getProjects(BaseRequest $request)
    {
        $projects = Project::all();
        $this->setData($projects);

        return $this->getResponse();
    }

    /**
     * @SWG\Post(
     *     path="/project/create",
     *     summary="створити проекти",
     *     tags={"Project"},
     *
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="назва проекта",
     *         required=true
     *     ),
     *
     *
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="опис проекта",
     *         required=false
     *     ),
     *
     *     @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         type="string",
     *         description="стас проекта валідація пропустить тільки NEW or OLD по дефолту стоїть NEW",
     *         required=false
     *     ),
     *
     *     @SWG\Response(
     *         response=200,
     *         description="об'єктів Project",
     *     @SWG\Schema(ref="#/definitions/Project"),
     *     ),
     * )
     */
    public function createProject(CreateProjectRequest $request)
    {
        $dataUser = $request->only([
            'name',
            'description',
            'status',
        ]);
        //у випадку коли не буде в апі відправдено 'description' та 'status' об'єкт який вертає create також буде без цих параметріа а в такому випадку коли мобільщики чекають всю модель так у них все упаде тому я просто дістаю з бази нову
        $projectId = Project::create($dataUser)->id;
        $project = Project::find($projectId);
        $this->setData($project);

        return $this->getResponse();
    }

    /**
     * @SWG\Post(
     *     path="/project/update",
     *     summary="обновити проекти",
     *     tags={"Project"},
     *
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         type="string",
     *         description="id проекта",
     *         required=true
     *     ),
     *
     *     @SWG\Parameter(
     *         name="name",
     *         in="query",
     *         type="string",
     *         description="назва проекта",
     *         required=true
     *     ),
     *
     *
     *     @SWG\Parameter(
     *         name="description",
     *         in="query",
     *         type="string",
     *         description="опис проекта",
     *         required=false
     *     ),
     *
     *     @SWG\Parameter(
     *         name="status",
     *         in="query",
     *         type="string",
     *         description="стас проекта валідація пропустить тільки NEW or OLD по дефолту стоїть NEW",
     *         required=false
     *     ),
     *
     *     @SWG\Response(
     *         response=200,
     *         description="об'єктів Project",
     *     @SWG\Schema(ref="#/definitions/Project"),
     *     ),
     * )
     */
    public function updateProject(UpdateProjectRequest $request)
    {
        $dataUser = $request->only([
            'id',
            'name',
            'description',
            'status',
        ]);

        Project::find($dataUser['id'])->update($dataUser);
        $project = Project::find($dataUser['id']);
        $this->setData($project);

        return $this->getResponse();
    }


}
