<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Form\ProfileUserType;
use App\Form\UserType;
use App\Entity\Machine;
use App\Form\MachineType;
use App\Repository\MachineRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    
    /**
     * @Route("/user/{byFirstname}", name="user_firstname")
     * @ParamConverter("user", options={"mapping"={"byFirstname"="firstname"}})
     */
    public function firstname(Request $request, UserRepository $userRepository, User $user, MachineRepository $machineRepository){
        $entityManager = $this->getDoctrine()->getManager();
        $machine = new Machine();

       /* $allMachines = $machineRepository->findBy(
            ['userId' => $user->getId()]
        );*/
        

        $form = $this->createForm(MachineType::class,$machine);
        $form->handleRequest($request);



        return $this->render('machine/index.html.twig', array('users'=> $user, 'categorie'=> $request->get("categorie")  )

        );

    }
}

