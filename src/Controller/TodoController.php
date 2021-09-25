<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TodoRepository;

class TodoController extends AbstractController
{
    public function getTodos(TodoRepository $todoRepository): JsonResponse
    {
        $todos = $todoRepository->findAll();
        $data = [];
        foreach ($todos as $todo) {
            $data[] = [
                'id' => $todo->getId(),
                'name' => $todo->getName(),
            ];
        }
        return new JsonResponse($data, 200);
    }

    public function addTodo(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $name = $data['name'];
        if (empty($name))
        {
            return new JsonResponse('Empty name', 422);
        }
        $newTodo = new Todo();
        $newTodo->setName($name);
        $entityManager->persist($newTodo);
        $entityManager->flush();
        return new JsonResponse('Todo was added successfully', 201);
    }

    public function deleteTodo(EntityManagerInterface $entityManager, TodoRepository $todoRepository, $id): JsonResponse
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

    public function updateTodo(Request $request, EntityManagerInterface $entityManager, TodoRepository $todoRepository, $id): JsonResponse
    {
        $todo = $todoRepository->find($id);
        if (!$todo)
        {
            return new JsonResponse('No todo by this id', 404);
        }
        $data = json_decode($request->getContent(), true);
        $Name = $data['name'];
        if (empty($Name))
        {
            return new JsonResponse('Empty name', 422);
        }
        $todo->setName($data['name']);
        $entityManager->persist($todo);
        $entityManager->flush();
        return new JsonResponse('Todo by this id was updated successfully', 200);
    }
}
