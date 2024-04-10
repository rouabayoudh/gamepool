const questions=[
    {
        question :"Who is known as the world's most famous detective?",
        answers:[
            {text:" Sherlock Holmes", correct:"1"},
            {text:"Hercule Poirot", correct:"0"},
            {text:"Miss Marple", correct:"0"},
            {text:"Sam Spade", correct:"0"},
            {text:"None of the above", correct:"0"},
        ]
    },
    {
        question :"What is the primary color associated with detective attire, such as trench coats and hats?",
        answers:[
            {text:"Red", correct:"0"},
            {text:"Blue", correct:"0"},
            {text:"Black", correct:"1"},
            {text:"Green", correct:"0"},
        ]
    },
    {
        question :"Which element is often used in detective stories to mislead the reader or investigator?",
        answers:[
            {text:" Clue", correct:"0"},
            {text:"Red herring", correct:"1"},
            {text:"Witness", correct:"0"},
            {text:"Alibi", correct:"0"},
        ]
    },
    {
        question :"What is the common term for the process of formally charging a suspect with a crime?",
        answers:[
            {text:"Arrest", correct:"0"},
            {text:" Interrogation", correct:"0"},
            {text:" Prosecution", correct:"0"},
            {text:" Indictment", correct:"1"},
            
        ]
    },
    {
        question :"If Detective Brown receives 10 pieces of evidence from the crime scene and labels each piece with a unique number from 1 to 10, what is the sum of all the numbers?",
        answers:[
            {text:"45", correct:"0"},
            {text:"55", correct:"1"},
            {text:"25", correct:"0"},
            {text:"65", correct:"0"},
        ]
    },
    {
        question :"If a suspect's alibi claims he was at a café from 7:00 PM to 8:30 PM, and the crime occurred at 7:45 PM, was the suspect present at the crime scene?",
        answers:[
            {text:"YES", correct:"1"},
            {text:"NO", correct:"0"},
        ]
    }
    
];
const questionElement=document.getElementById("question");
const answerButton=document.getElementById("answerbuttons");
const nextButton=document.getElementById("next");
const toggleButton = document.getElementById("btnpr");
const appContainer = document.getElementById("app");
const Bbutton = document.getElementById("B");

let index =-2;
let score=0;
function startquiz(){
    BbuttonClicked = false;
    OKbutton=false;
    score=0;
    Bbutton.style.cursor = "pointer";
    toggleButton.style.cursor = "pointer";
    index=0;
    nextButton.innerHTML="Next";
    show();
}
function show(){ //affiche la question actuelle et ses réponses
    document.getElementById("next1").style.display="none";
    document.getElementById("next2").style.display="none";
    reset();  //réinitialise l'état de l'interface
    let thisquestion=questions[index];
    let questionno=index + 1;
    questionElement.innerHTML=questionno+". "+thisquestion.question;
    thisquestion.answers.forEach(answer =>{
        const button=document.createElement("button");   //Crée un bouton HTML pour afficher la réponse
        button.innerHTML=answer.text;
        button.dataset.value = answer.correct;
        button.classList.add("btn");
        answerButton.appendChild(button);  // Ajoute le bouton à l'élément HTML 'answerButton' qui contient les boutons de réponse
        button.addEventListener("click",selectanswer) //  événement  pour gérer la sélection de la réponse
    });
}
function reset(){  //réinitialise l'état de l'interface
    nextButton.style.display="none";
    while(answerButton.firstChild){
        answerButton.removeChild(answerButton.firstChild);  //// Supprime tous les éléments enfants de l'élément HTML 'answerButton'
    }
}
function end(){ // interface finale du quiz
    reset();
    const data = { "score": score };  // Crée un objet JSON contenant le score à envoyer au serveur
    fetch('score.php', {  // Envoie les données JSON au serveur via une requête POST à 'score.php'
        "method": 'POST',
        "headers": {
            'Content-Type': 'application/json'
        },
        'body': JSON.stringify(data)
    })
    .then(function(response){ // Traite la réponse de la requête
        return response.text();  // Retourne la réponse au format texte
    }).then(function(data){   // Gère les données de la réponse
        console.log(data);}) // Affiche les données reçues dans la console (verification)
    // modification du contenu des textes et des boutons
    document.getElementById("titre").innerHTML=`You've completed the Detective quiz 🔍 SCORE: ${score}/600`;
    questionElement.style.fontSize="18px";
    questionElement.innerHTML="Now that you've warmed up, get ready to dive deeper into the world of mysteries and challenges......Your journey as a detective is about to begin.";
    nextButton.innerHTML="PLAY";
    nextButton.style.background="#500404" ;
    nextButton.style.display="block";
    // affichage de deux nouveaux boutons cachés depuis le début
    
    document.getElementById("next2").style.display="block";
}
function selectanswer(e){ //gère la sélection d'une réponse du quiz
    const answerButtons = document.querySelectorAll('.btn');
    answerButtons.forEach(button => {
        button.disabled=true; //empêcher une sélection supplémentaire de boutons en les désactivant
    });

    const selectedButton = e.target;
    selectedButton.classList.add('selected');
    if (selectedButton.dataset.value === "1") { //vérification de la valeur du dataset 'value'
        score+=100;
    }
    nextButton.style.display="block"; // affichage du bouton next pour continuer
}
function nextbtn(){ //gère le passage à la question suivante
    index++;
    if(index<questions.length){
        show(); //continuer l'affichage des questions
    }else{
        end();  //fin du jeu :interface finale
    }
}
let OKbutton = false; //Condition sur le bouton du téléphone;
//action du bouton selon l'index: faire apparaitre et disparaitre l'interface selon les boutons du pc et du telephone 
nextButton.addEventListener("click",()=>{
    if(index==-2){
        appContainer.style.display ="none" ;
        index++;
        OKbutton=true;
        Bbutton.style.cursor = "pointer";
    }
    else if (index==-1){
        BbuttonClicked = true; // Mettre BbuttonClicked à true lorsque Bbutton est cliquée
        appContainer.style.display ="none" ;
        index++;
        toggleButton.style.cursor = "pointer";
    }
    else if(index<questions.length){ //passe à la question suivante
        nextbtn();
    }else{// fin des question :le bouton dirige selon le score vers differents jeux
        if (score <= 200) {
            window.location.href ="https://www.silvergames.com/fr/anitas-job";
          } else if (200 <score<= 400) {
            window.location.href ="https://www.silvergames.com/fr/the-heist";
          } else {
            window.location.href ="https://www.silvergames.com/fr/hidden-crime-investigation";
          }
    }
});
// affichage du "Welcome" et les regles du jeu
appContainer.style.display ="block" ; 
document.getElementById("titre").innerHTML="You Are In The Secret Room! 🕵️‍♂️"
questionElement.innerHTML="Look around carefully and search for clues to begin your adventure.🔍<br><br> ---Check the PHONE on the desk ---<br>The game starts with a quiz. Pay attention and good luck! <br><br>You can inspect your Detective items or exit through the door on the right 🚪🚶‍♂️.";
nextButton.innerHTML="Ok";
//on cache les boutons du feedback et du store jusqu'à la fin du quiz 
//document.getElementById("next1").style.display="none";
document.getElementById("next2").style.display="none";


let BbuttonClicked = false; // Variable pour vérifier si Bbutton a été cliquée


// bouton du pc qui affiche le quiz
toggleButton.addEventListener("click", () => {
    if (BbuttonClicked) { // Vérifier si Bbutton a été cliquée
        appContainer.style.display = "block";
        document.getElementById("titre").innerHTML = "Sherlock's Logic Quest 🕵️‍♂️";
        startquiz();
    }
});
//bouton du telephone et autres regles du jeu
Bbutton.addEventListener("click", () => {
    if(OKbutton){
        BbuttonClicked = false; 
        document.getElementById("next1").style.display="none";
        document.getElementById("next2").style.display="none";
        index = -1;
        appContainer.style.display = "block";
        document.getElementById("titre").innerHTML = "📞 Ring... ring... Ahoy! 📞";
        questionElement.innerHTML = "Hello there! <br> To begin your quest 🔍, simply tap on the PC screen.<br><br>Remember, you can only answer each question once.Your score determines your amount of money. You can either PLAY with it or SHOP, so choose wisely.<br><br> Good luck and enjoy the challenge!";
        nextButton.innerHTML = "OK";
    }
});

document.getElementById("door").addEventListener("click", function() {
    window.location.href = "start.php";
});
