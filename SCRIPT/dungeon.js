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

            this.stats = await fetch("../API/Heros.php", {
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

        console.log(this.stats)

    }

    async updateUI() {

        document.getElementById("char_port").classList.add(`${this.stats["eName"]}_${this.stats["gender"]}`)

        document.getElementById("heroName").innerText = this.stats["name"];

        document.getElementById("level").innerText  = this.stats["level"];
        document.getElementById("race").innerText   = this.stats["eName"];
        document.getElementById("class").innerText  = this.stats["class"];

        document.getElementById("exp").innerText = this.stats["experience"];

        document.getElementById("str_score").innerText = this.stats["str_score"];
        document.getElementById("dex_score").innerText = this.stats["dex_score"];
        document.getElementById("int_score").innerText = this.stats["int_score"];
        document.getElementById("con_score").innerText = this.stats["con_score"];


    }

    def(damage) {

        this.stats.eBaseHP -= Math.round(damage * (100/(100+parseInt(this.stats.eBaseDef) * 4)));
        this.updateUI();

        if (this.monster.eBaseHP <= 0 ) {

            console.log('Tu es mort ;3');

        }

    }

}

class Monster {

    constructor(_ID){

        this.load(this._ID = 6);

    }

    async load() {

        try {

            this.monster = await fetch("../API/Monsters.php", {
                method: "POST",
                body : JSON.stringify({
                    methode: "jsonSerialize",
                    id: this._ID
                })
            }).then( ( req ) => req.json() );

            console.log(this.monster)

            //this.updateUI();

        } catch (error) {
            throw new Error(error);
        }



    }

    async updateUI() {

        console.log(this.monster);

    }

    async attaque() {

        hero.def();

    }

    def(damage) {

        this.monster.eBaseHP -= Math.round(damage * (100/(100+parseInt(this.monster.eBaseDef) * 4)));
        this.updateUI();

        if (this.monster.eBaseHP <= 0 ) {

            console.log('Tu es mort ;3');

        }

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


const attaqueBtn    = document.getElementById("attaque")
    , action1       = document.getElementById("agir")
    , action2       = document.getElementById("rester");


let turn = true;


function changeTurn() {

    turn = !turn;

    attaqueBtn.toggleAttribute("disabled");
    action1.toggleAttribute("disabled");
    action2.toggleAttribute("disabled");

    if (turn === false) {

        setTimeout(() => {
            monster.attaque("HELLO");
            changeTurn()
        }, 1000);

    }

}

attaqueBtn.addEventListener("click", async () => {

    if (turn === true) {
        monster.def(hero.stats.eBaseStr);
        changeTurn()
    }



}, true )



// document.getElementById("attaque").addEventListener("click", async () => {

//     if (turn === true) {



//     }






//     monster.lostHP(hero.stats.eBaseStr);

// }, true)
