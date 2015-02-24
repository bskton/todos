<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\Task;

class TaskController extends Controller
{
    /**
     * @Route("/task", name="tasks")
     */
    public function indexAction()
    {
        $tasks = $this->getDoctrine()->getRepository('AppBundle:Task')->findAllUncompleted();

        return $this->render('AppBundle:Task:index.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/task/new", name="new_task")
     */
    public function newAction(Request $request)
    {
        $task = new Task();

        $form = $this->createForm('task', $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('tasks'));
        }

        return $this->render('AppBundle:Task:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/task/edit/{id}", name="edit_task", requirements={"id": "\d+"})
     */
    public function editAction($id, Request $request)
    {
        $task = $this->getTask($id);

        $form = $this->createForm('task', $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl('tasks'));
        }

        return $this->render('AppBundle:Task:edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/task/complete/{id}", name="complete_task", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function completeAction($id, Request $request) {
        $completed = $request->request->get('completed');
        $completed = $completed == 'true' ? true : false;

        $task = $this->getTask($id);

        $task->setCompleted($completed);
        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }

    /**
     * Get task entity
     *
     * Get task entity by id from repository
     *
     * @param integer $id Task identifier
     * @return AppBundle/Entity/Task
     */
    private function getTask($id)
    {
        $task = $this->getDoctrine()->getRepository('AppBundle:Task')->find($id);

        if (!$task) {
            throw $this->createNotFoundException('Не найдено задание с ID '.$id);
        }

        return $task;
    }
}
