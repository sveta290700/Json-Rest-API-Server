<?php

namespace App\Controller;

use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TodoRepository;

class TodoController extends AbstractController
{
    /**
     * @Route("/todo", name="get_todos", methods={"GET"})
     * @param TodoRepository $todoRepository
     * @return JsonResponse
     */
    public function getTodos(TodoRepository $todoRepository) : JsonResponse
    {
        $todos = $todoRepository->findAll();
        $data = [];
        foreach ($todos as $todo) {
            $data[] = [
                'id' => $todo->getId(),
                'Name' => $todo->getName(),
            ];
        }
        return new JsonResponse($data, 200);
    }

    /**
     * @Route("/todo", name="add_todo", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function addTodo(Request $request, EntityManagerInterface $entityManager) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $Name = $data['Name'];
        if (empty($Name))
        {
            return new JsonResponse('No todo by this id', 422);
        }
        $newTodo = new Todo();
        $newTodo->setName($Name);
        $entityManager->persist($newTodo);
        $entityManager->flush();
        return new JsonResponse('Todo was added successfully', 201);
    }

    /**
     * @Route("/todo/{id}", name="delete_todo", methods={"DELETE"})
     * @param EntityManagerInterface $entityManager
     * @param TodoRepository $todoRepository
     * @param $id
     * @return JsonResponse
     */
    public function deleteTodo(EntityManagerInterface $entityManager, TodoRepository $todoRepository, $id) : JsonResponse
    {
        $todo = $todoRepository->find($id);
        if (!$todo)
        {
            return new JsonResponse('No todo by this id', 404);
        }
        $entityManager->remove($todo);
        $entityManager->flush();
        return new JsonResponse('Todo by this id was deleted successfully', 200);
    }

    /**
     * @Route("/todo/{id}", name="put_todo", methods={"PUT"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TodoRepository $todoRepository
     * @param $id
     * @return JsonResponse
     */
    public function updatePost(Request $request, EntityManagerInterface $entityManager, TodoRepository $todoRepository, $id) : JsonResponse
    {
        $todo = $todoRepository->find($id);
        if (!$todo)
            {
                return new JsonResponse('No todo by this id', 404);
            }
        $data = json_decode($request->getContent(), true);
        $Name = $data['Name'];
        if (empty($Name))
            {
                return new JsonResponse('No todo by this id', 422);
            }
        $todo->setName($data['Name']);
        $entityManager->persist($todo);
        $entityManager->flush();
        return new JsonResponse('Todo by this id was updated successfully', 200);
    }
}