class Dungeon {

  constructor(floor) {

    this.floor = floor;

    let event = Math.round(Math.random() * 10);

    console.log({
        [0]: "chest",
        [1]: "shop",
        [2]: "mob"
    }[event > 1 ? 2 : event])

  }

  async mob() {

        this.mob = await fetch("../API/Heros.php", {
                method: "POST",
                body : JSON.stringify({
                    methode: "jsonSerialize",
                    id: this._ID
                })
            }).then( ( req ) => req.json() );

  }

}

class Hero {

    constructor(_ID){

        this.load(this._ID = _ID);

    }

    async load() {

        try {

            this.hero = await fetch("../API/Heros.php", {
                method: "POST",
                body : JSON.stringify({
                    methode: "jsonSerialize",
                    id: this._ID
                })
            }).then( ( req ) => req.json() );

            this.updateUI();

        } catch (error) {
            throw new Error(error);
        }

        console.log(this.hero)

    }

    async updateUI() {

        document.getElementById("char_port").classList.add(`${this.hero["eName"]}_${this.hero["gender"]}`)

        document.getElementById("heroName").innerText = this.hero["name"];

        document.getElementById("level").innerText  = this.hero["level"];
        document.getElementById("race").innerText   = this.hero["eName"];
        document.getElementById("class").innerText  = this.hero["class"];

        document.getElementById("exp").innerText = this.hero["experience"];

        document.getElementById("str_score").innerText = this.hero["str_score"];
        document.getElementById("dex_score").innerText = this.hero["dex_score"];
        document.getElementById("int_score").innerText = this.hero["int_score"];
        document.getElementById("con_score").innerText = this.hero["con_score"];


    }

}

// // —— Dice
// const d = (faces) =>  (Math.floor(Math.random() * faces) + 1);


// const statBonus = (stat) => Math.round((stat - 11) / 2)

//     , maxSP = () => Math.round(sp_multi * level) + (int_bonus*2);


// let hero = {

//     maxHP : (constitution, level) => 7 + statBonus(constitution) + level,

// }


// async function loadCharacter (userID) {

//     console.log("————— Dungeon script loaded");

//     console.log(userID)

//     const characterData = await fetch("../API/Heros.php", {
//         method: "POST",
//         body: JSON.stringify({
//             methode: "jsonSerialize",
//             id: userID,
//         })
//     }).then ( ( res ) => res.json() );

//     Object.assign(hero, characterData)

//     // —— Loads information

//     document.getElementById("char_port").classList.add(`${hero["eName"]}_${characterData["gender"]}`)
//     document.getElementById("heroName").innerText = hero["name"];

//     document.getElementById("currentHP").innerText = hero.maxHP(
//         parseInt(hero["con_score"], 10),
//         parseInt(hero["level"], 10)
//     );

//     // if (hero["class"] === "Fighter") {
//     //     mysp = 0;
//     //     maxsp = sp = 0
//     // }

//     // if (myclass == "Fighter") {
//     //     mysp = 0;
//     //     maxsp = mysp;
//     //   } else {
//     //     mysp = Math.round(sp_multi * mylvl) + (int_bonus*2);
//     //     maxsp = mysp;
//     //   };
//     //   if (mysp < 0) {
//     //     mysp = 0
//     //   };

//     // document.getElementById("currentMP").innerText = maxHP(
//     //     parseInt(characterData["con_score"], 10),
//     //     parseInt(characterData["level"], 10)
//     // );

//     console.log(characterData);

// }


document.getElementById("toggle").addEventListener("click", (e) => {
    document.getElementById("charscreen").classList.toggle("open");
})