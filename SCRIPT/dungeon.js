class Dungeon {

  constructor(floor) {

    this.floor = floor;

  }

}

// —— Dice
const d = (faces) =>  (Math.floor(Math.random() * faces) + 1);


const statBonus = (stat) => Math.round((stat - 11) / 2)

    , maxSP = () => Math.round(sp_multi * level) + (int_bonus*2);


let hero = {

    maxHP : (constitution, level) => 7 + statBonus(constitution) + level,

}


async function loadCharacter (userID) {

    console.log("————— Dungeon script loaded");

    console.log(userID)

    const characterData = await fetch("../API/Heros.php", {
        method: "POST",
        body: JSON.stringify({
            methode: "jsonSerialize",
            id: userID,
        })
    }).then ( ( res ) => res.json() );

    Object.assign(hero, characterData)

    // —— Loads information

    document.getElementById("char_port").classList.add(`${hero["eName"]}_${characterData["gender"]}`)
    document.getElementById("heroName").innerText = hero["name"];

    document.getElementById("currentHP").innerText = hero.maxHP(
        parseInt(hero["con_score"], 10),
        parseInt(hero["level"], 10)
    );

    // if (hero["class"] === "Fighter") {
    //     mysp = 0;
    //     maxsp = sp = 0
    // }

    // if (myclass == "Fighter") {
    //     mysp = 0;
    //     maxsp = mysp;
    //   } else {
    //     mysp = Math.round(sp_multi * mylvl) + (int_bonus*2);
    //     maxsp = mysp;
    //   };
    //   if (mysp < 0) {
    //     mysp = 0
    //   };

    // document.getElementById("currentMP").innerText = maxHP(
    //     parseInt(characterData["con_score"], 10),
    //     parseInt(characterData["level"], 10)
    // );

    console.log(characterData);

}


document.getElementById("toggle").addEventListener("click", (e) => {
    document.getElementById("charscreen").classList.toggle("open");
})