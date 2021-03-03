class Dungeon {

    constructor (_heroID) {

        this._heroID = _heroID;
        this.start = Date.now();

    }

    async load(){

        // —— Load character data
        this.Hero = await fetch("../API/Heros.php", {
            method: "POST",
            body : JSON.stringify({
                methode: "jsonSerialize",
                id: this._heroID
            })
        }).then( ( res ) => res.json() );

        console.log(this.Hero);

        this.updateHeroUI();

        // —— Defined on the user will face a monster, or meet a chest or a merchant

        const monsters = [...this.Hero.fmonsters, "shop", "chest"];

        this.target = monsters[~~(Math.random() * monsters.length)];

        if (!isNaN(this.target)) {

            // —— Load character data
            this.target = await fetch("../API/Monsters.php", {
                method: "POST",
                body : JSON.stringify({
                    methode: "jsonSerialize",
                    id: this.target
                })
            }).then( ( res ) => res.json() );

            console.table(this.target);

            this.target.HP = this.target.eBaseHP;
            this.updateMonsterUI();

            this.loadInteractions();
        }

        this.log(`${this.Hero.name} opens the doors to the ${this.Hero.floor} floor`)

    }

    updateHeroUI() {

        document.getElementById("char_port" ).classList.add(`${this.Hero.eName}_${this.Hero.gender}`);
        document.getElementById("heroName"  ).innerHTML = this.Hero.name;
        document.getElementById("currentHP" ).innerHTML = this.Hero.HP;
        document.getElementById("currentMP" ).innerHTML = this.Hero.MP;

        document.getElementById("level"     ).innerHTML = this.Hero.level;
        document.getElementById("race"      ).innerHTML = this.Hero.eName;
        document.getElementById("class"     ).innerHTML = this.Hero.class;
        document.getElementById("exp"       ).innerHTML = this.Hero.experience;
        document.getElementById("potions"   ).innerHTML = 2; // —— The time I create the backend

        document.getElementById("str_score" ).innerHTML = this.Hero.str_score;
        document.getElementById("dex_score" ).innerHTML = this.Hero.dex_score;
        document.getElementById("int_score" ).innerHTML = this.Hero.int_score;
        document.getElementById("def_score" ).innerHTML = this.Hero.def_score;

        document.getElementById("class"     ).innerHTML = this.Hero.class;
        document.getElementById("class"     ).innerHTML = this.Hero.class;

        this.generateHPBar(2, 20)

    }

    updateMonsterUI() {

        document.getElementById("monsterName").innerHTML = this.target.eName;
        document.getElementById("monsterHP").innerHTML = this.generateHPBar(this.target.eBaseHP, this.target.HP);

    }


    generateHPBar (maxHP, HP) {

        let base = new Array(30).fill("░");
        let current = new Array(~~(HP / maxHP * 30)).fill("▓").join("")

        base.push(` ${HP} / ${maxHP}`)
        base.splice(0, current.length, current );

        return base.join("");

    }

    async victory() {
        document.getElementById("monster").style.display = "none";
        this.log("—— V I C T O R Y ——");
        this.Hero = await fetch("../API/Heros.php", {
            method: "POST",
            body : JSON.stringify({
                methode: "saveFight",
                id: this._heroID
            })
        })
    }

    dead() {
        this.log("—— MORT DU JOUEUR ——")
    }

    log(content) {

        var oUl = document.getElementById("messages"); 

        var oLi = document.createElement("li");
        var oText = document.createTextNode(content);

        oLi.appendChild(oText);
        oUl.appendChild(oLi);

    }

    loadInteractions() {

        const attack = document.getElementById("attack")

        attack.addEventListener("click", () => {

            let damages = Math.round(this.Hero.str_score * (100/(100 + (this.target.eBaseDef) * 4)));

            if ((Math.random() * 100) < this.Hero.dex_score) {

                damages *= 2;
                this.log(`Critical hit! ${this.Hero.name} inflicts ${damages} damage to ${this.target.eName}`)

            } else {

                this.log(`${this.Hero.name} inflicts ${damages} damage to ${this.target.eName}`)

            }

            this.target.HP -= damages;

            console.clear();
            console.table(this.Hero);
            console.table(this.target);

            if (this.target.HP <= 0) {
                return this.victory();
            } else this.updateMonsterUI()

            attack.toggleAttribute("disabled");
            setTimeout(() => {
                attack.toggleAttribute("disabled");

                damages = Math.round(this.target.eBaseStr * (100/(100+ (this.Hero.eBaseDef) * 4)));
                this.Hero.HP -= damages;

                this.log(`${this.target.eName } responds by inflicting ${damages} damages too.`)

                if (this.Hero.HP <= 0)
                    this.dead();
                else
                    this.updateHeroUI();

            }, 200)


        })
    }

}