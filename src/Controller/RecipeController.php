<?php


namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
//$method = $_SERVER['REQUEST_METHOD'];
/*if ($method == "OPTIONS") {
    die();
}*/

class RecipeController extends AbstractController
{
    #[Route('/recipe', name: 'recipe')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecipeController.php',
        ]);
    }
    /**
     * @Route("/recipe/add", name="add_new_recipe")
     */
    public function addRecipe(){
        $entityManager = $this->getDoctrine()->getManager();

        $newRecipe = new Recipe();
        $newRecipe->setName('Mint Chocolate Cheesecake');
        $newRecipe->setImg("https://source.unsplash.com/Ao09kk2ovB0/1600x900");
        $newRecipe->setprepTime("20");
        $newRecipe->setcookTime("35");
        $newRecipe->setServes("16");
        $newRecipe->setIngrnumber("10");
        $newRecipe->setIngredients([
            "20 chocolate wafer cookies",
            "3 tablespoons unsalted butter",
            "melted 3 tablespoons sugar",
            "Pinch fine salt",
            "8 ounces semisweet chocolate, finely chopped",
            "8 ounces cream cheese, at room temperature",
            "1 1/3 cups sugar, divided",
            "1 1/2 cups sour cream, divided",
            "2 large eggs, at room temperature",
            "1/4 cup white creme de menthe (see Cook's Note )",
            "3 drops natural green food coloring, optional",
            "Chocolate curls, for garnish"
        ]);
        $newRecipe->setCategory("sweets");
        $newRecipe->setDescription([
            "For the crust: Preheat oven to 175°C. Spray an 8-inch square metal baking pan with nonstick spray and line with foil.",
            "Pulse the cookies in a food processor with the butter, sugar, and salt to make a fine crust. Evenly press the crust into the prepared pan taking care to cover the bottom completely. Bake until the crust sets, about 15 minutes.",
            "Meanwhile, make the filling: Put the chocolate in a medium microwave-safe bowl; heat at 75 percent power until softened, about 2 minutes. Stir, and continue to microwave until completely melted, up to 2 minutes more. (Alternatively put the chocolate in a heatproof bowl. Bring a saucepan filled with an inch or so of water to a very slow simmer; set the bowl over, but not touching, the water, and stir occasionally until melted and smooth.) Blend the cream cheese, 2/3 cup of the sugar, and 1/2 cup of the sour cream together in the food processor until smooth.",
            "Scrape down the sides, as needed. Add the eggs and melted chocolate then pulse until just incorporated and smooth. Pour the filling evenly over the crust and bake until the filling puffs slightly around the edges and just set in the center, about 20 minutes.",
            "Mix the remaining cup of sour cream and 2/3 cup sugar with the creme de menthe and food coloring, if using. Carefully, spoon the mixture over the top of the chocolate and gently spread into an even layer. Bake until topping becomes glossy but is still a bit loose, about 15 minutes more. (The topping will set when cooled.) Cool on a rack. Cover and refrigerate for at least 2 hours or overnight.",
            "Lift cheesecake out of the pan, cut into 2-inch squares, and top with chocolate curls.",
            " Cook's Note: We prefer the delicate natural flavour of white creme de menthe versus the green."
        ]);

        $entityManager->persist($newRecipe);


        $entityManager->flush();

        return new Response('trying to add new recipe...'  . $newRecipe->getId() . " ". $newRecipe->getName());
    }

    /**
     * @Route("/recipe/addmore", name="add_more")
     */
    public function addmoreRecipe(Request $request){

        $name=$request->request->get('name');
        $img=$request->request->get('img');
        $prepTime=$request->request->get('prepTime');
        $cookTime=$request->request->get('cookTime');
        $serves=$request->request->get('serves');
        $ingrnumber=$request->request->get('ingrnumber');
        $ingredients=$request->request->get('ingredients');
        $category=$request->request->get('category');
        $description=$request->request->get('description');

        $entityManager = $this->getDoctrine()->getManager();
        $newRecipe = new Recipe();
        $newRecipe->setName($name);
        $newRecipe->setImg($img);
        $newRecipe->setprepTime($prepTime);
        $newRecipe->setcookTime($cookTime);
        $newRecipe->setServes($serves);
        $newRecipe->setIngrnumber($ingrnumber);
        $newRecipe->setIngredients([
            $ingredients
        ]);
        $newRecipe->setCategory($category);
        $newRecipe->setDescription([
            $description
        ]);

        $entityManager->persist($newRecipe);


        $entityManager->flush();

        return new Response('trying to add new recipe...'  . $newRecipe->getId() . " ". $newRecipe->getName());
    }

    /**
     * @Route("/recipe/all", name="get_all_recipe")
     */
    public function getAllRecipe()
    {
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
        $response = [];

        foreach ($recipes as $recipe) {
            $response[] = array(
                'id'=>$recipe->getId(),
                'name' => $recipe->getName(),
                'ingredients' => $recipe->getIngredients(),
                'img' => $recipe->getimg(),
                'prepTime' => $recipe->getprepTime(),
                'cookTime' => $recipe->getcookTime(),
                'serves' => $recipe->getserves(),
                'ingrnumber' => $recipe->getingrnumber(),
                'description' => $recipe->getdescription(),
                'category' => $recipe->getcategory(),
            );
        }
        return $this->json($response);
    }

    /**
     * @Route("/recipe/find/{id}", name="find")
     */
    public function findRecipe($id) {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            return $this->json([
                'id'=>$recipe->getId(),
                'name'=>$recipe->getName(),
                'ingredients'=>$recipe->getIngredients(),
                'img'=>$recipe->getimg(),
                'prepTime'=>$recipe->getprepTime(),
                'cookTime'=>$recipe->getcookTime(),
                'serves'=>$recipe->getserves(),
                'ingrnumber'=>$recipe->getingrnumber(),
                'description'=>$recipe->getdescription(),
                'category'=>$recipe->getcategory(),
            ]);
        }
    }

    /**
     * @Route("/recipe/addnew", name="add_new_query_recipe")
     */
    public function recipe(Request $request)
    {

        $name=$request->query->get('name');
        $img=$request->query->get('img');
        $prepTime=$request->query->get(key: 'prepTime');
        $cookTime=$request->query->get(key: 'cookTime');
        $serves=$request->query->get(key: 'serves');
        $ingrnumber=$request->query->get(key: 'ingrnumber');

        $ingredients[]=$request->query->get( key: 'ingrfield');

        $category=$request->query->get(key: 'category');
        $description[]=$request->query->get(key: 'desc');



        $entityManager = $this->getDoctrine()->getManager();

        $newRecipe = new Recipe();
        $newRecipe->setName($name);
        $newRecipe->setImg($img);
        $newRecipe->setPrepTime($prepTime);
        $newRecipe->setCookTime($cookTime);
        $newRecipe->setServes($serves);
        $newRecipe->setIngrnumber($ingrnumber);

        $newRecipe->setIngredients((array)$ingredients);
        $newRecipe->setCategory($category);
        $newRecipe->setDescription((array)$description);




        $entityManager->persist($newRecipe);


        $entityManager->flush();

        return new Response('adding new recipe...' . $newRecipe->getId() . $newRecipe->getName());



    }

    /**
     * @Route("/recipe/edit/{id}/{name}")
     */
    public function editRecipe($id, $name) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $recipe->setName($name);
            $entityManager->flush();

            return $this->json([
                'message' => 'Edited a recipe with id ' . $id
            ]);
        }
    }

    /**
     * @Route("/recipe/remove/{id}", name="remove_a_recipe")
     */
    public function removeRecipe($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $entityManager->remove($recipe);
            $entityManager->flush();

            return $this->json([
                'message' => 'Removed the recipe with id ' . $id
            ]);
        }

    }

}
