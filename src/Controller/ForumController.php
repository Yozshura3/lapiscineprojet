<?php


namespace App\Controller;


use App\Entity\Categories;
use App\Entity\PostSujet;
use App\Form\CategoriesType;
use App\Form\TopicType;
use App\Repository\CategoriesRepository;
use App\Repository\PostSujetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum_accueil")
     */
    public function forumController(CategoriesRepository $categoriesRepository)
    {

        $category = $categoriesRepository->findAll();

        return $this->render('forum/forum_accueil.html.twig', [
            'categories' => $categoriesRepository->categoriesAndSubCategories()
        ]);
    }

    /**
     * @Route("/forum/{idCategory}", name="forum_category")
     */
    public function category(PostSujetRepository $postSujetRepository,CategoriesRepository $categoriesRepository, $idCategory)
    {
        $subCategories = $categoriesRepository->getSubCategories($idCategory);
        $posts = NULL;
        //TODO Linker post/sujet aux sub categories

        $topics = $postSujetRepository->findAll();

    return $this->render('forum/forum_category.html.twig', [
        'subCategories' => $subCategories,
        'posts' => $posts,
        'topics' => $topics
    ]);
    }



    /**
     * @Route("/forum/admin/insert_category", name="insert_category")
     */
    public function insertForumCategory(Request $request, EntityManagerInterface $entityManager)
    {
        // Je créé une nouvelle catégorie, en créant une nouvelle instance de l'entité Categories
        $category = new Categories();

        // J'utilise la méthode createForm pour créer le gabarit
        // de mon formulaire pour la categorie: CategoriesType
        // que j'ai généré via la console en ligne de commandes,
        // et je lui associe mon entité Categories vide.

        $categoryForm = $this->createForm(CategoriesType::class, $category);
        // J'utilise un if pour vérifier si un formulaire a bien
        // été envoyé par la méthode POST.
        if ($request->isMethod('POST')) {
            // Si tel est le cas, alors je récupère les données de
            // la requête POST et je l'associe à mon formulaire.
            $categoryForm->handleRequest($request);

            // Si les données entrées dans mes inputs sont corrects
            // et respectent bien tout les champs obligatoires.
            if ($categoryForm->isValid()) {

                // Alors j'enregistre en BDD ma variable $category qui a
                // été rempli avec les données du formulaire
                $entityManager->persist($category);
                $entityManager->flush();
            }
        }
        // A partir de mon gabarit, je crée la vue de mon Formulaire
        $categoryFormView = $categoryForm->createView();

        // puis je retourne un ficher twig et je lui envois ma variable
        // qui contient mon formulaire
        return $this->render('forum/admin_insert_category.html.twig', [
            'categoryFormView' => $categoryFormView
        ]);
    }

    /**
     * @Route("/forum/form/insert_topic", name="insert_topic")
     */
    public function topicFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        $topic = new PostSujet();

        $form = $this->createForm(TopicType::class, $topic);


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $entityManager->persist($topic);
                $entityManager->flush();

                return $this->redirectToRoute('forum_accueil');
            }
        }
        $topicFormView = $form->createView();

        return $this->render('forum/insert_topic.html.twig', [
            'topicFormView' => $topicFormView
        ]);

    }

    /**
     * @Route("/forum/update_topic/{id}", name="update_topic")
     */
    public function updateTopicForm(PostSujetRepository $postSujetRepository, EntityManagerInterface $entityManager, Request $request, $id)
    {
        $topic = $postSujetRepository->find($id);
        $topicForm = $this->createForm(TopicType::class, $topic);
        if ($request->isMethod('POST'))
        {
            $topicForm->handleRequest($request);

            if($topicForm->isValid()) {
                $entityManager->persist($topic);
                $entityManager->flush();
                return $this->redirectToRoute('forum_accueil');
            }
        }
        $topicFormView = $topicForm->createView();

        return $this->render('forum/insert_topic.html.twig', [
            'topicFormView' => $topicFormView
        ]);
    }

    /**
     * @Route("/forum/delete_topic/{id}", name="delete_topic")
     */
    public function deleteTopic(PostSujetRepository $postSujetRepository, EntityManagerInterface $entityManager, Request $request, $id)
    {
        $topic = $postSujetRepository->find($id);
        $entityManager->remove($topic);
        $entityManager->flush();

        return $this->redirectToRoute('forum_accueil');
    }

}