var questions = [
    {
          prompt: "Combien j'ai de fenêtres dans ma chambre?\n(a) Une seule\n\ (b) Deux c'est mieux\n(c) trois, Toujours dans l'exces",
          answer: "c"
    },
    {
         prompt: "Est-ce-que j'aime Naruto ?\n(a) Oui\n\ (b) Non\n(c) Seulement une partie de l'animé",
         answer: "a"
    },
    {
         prompt: "Combien de soeurs ai-je ?\n(a) Une\n\ (b) Deux\n(c) Trois",
         answer: "b"
    },
    {
        prompt: "Quel sport est-ce-que je pratique ?\n(a) Du football\n\ (b) Du Javelo\n(c) Du Waterpolo",
        answer: "b"
     },
     {
        prompt: "Quelle est la couleur de mon bureau ?\n(a) Bois\n\ (b) Blanc\n(c) Noir",
        answer: "c"
    }
];
var score = 0;

for(var i = 0; i < questions.length; i++){
    var response = window.prompt(questions[i].prompt);
    if(response == questions[i].answer){
         score++;
         alert("Correct!");
    } else {
         alert("WRONG!");
    }
}
alert("you got " + score*20 + "/" + questions.length*20);