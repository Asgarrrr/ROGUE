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

        if (this.Hero.skillsPoint)
            this.upgrade();

        this.updateHeroUI();

        // —— Defined on the user will face a monster, or meet a chest or a merchant

        const monsters = [...this.Hero.fmonsters, "inn", "chest"];

        this.target = monsters[~~(Math.random() * monsters.length)];

        if (!isNaN(this.target)) {

            // —— Load character data
            this.target = await fetch("../API/Monsters.php", {
                method: "POST",
                body : JSON.stringify({
                    methode: "jsonSerialize",
                    id: this.target,
                    floor: this.Hero.floor
                })
            }).then( ( res ) => res.json() );

            console.table(this.target);

            this.target.HP = this.target.eBaseHP;
            this.updateMonsterUI();

            this.loadInteractions();
        } else {

            const message = document.getElementById("message")
                , open = document.getElementById("retry")
                , skip = document.getElementById("nextfloor");

                open.style.display = "inline";
                skip.style.display = "inline";

            if (this.target === "chest") {

                message.innerText = "You have found a chest, gleaming it seems full of treasure..."

                open.value = "Open the chest";

                skip.value = "Leave the chest behind you";

                open.addEventListener("click", () => {

                    if ( ~~(Math.random() * 5) === 1 ) {
                        message.innerHTML = "You found a potion, lucky you";
                        this.Hero.potion++;
                    } else {

                        const golds = ~~(Math.random() * 30) + 20;
                        message.innerHTML = `You found ${golds} golds, not bad !`;
                        this.Hero.gold += golds

                    }
                    open.disabled = true;
                    this.save();
                    this.updateHeroUI();

                }, true);

            }

            if (this.target === "inn") {

                message.innerText = "On the horizon, you can see a shabby little inn, you are thinking of resting ..."

                open.value = "Rest ( - 50 gold )";
                skip.value = "Go away";

                open.addEventListener("click", () => {

                    if (this.Hero.gold < 50)
                        return this.log("You don't have enough money to stay here");

                    this.Hero.gold -= 50;
                    this.Hero.HP = this.Hero.maxHP;
                    this.Hero.MP = this.Hero.maxMP;

                    this.save();
                    this.updateHeroUI();

                }, true)

            }

            skip.addEventListener("click", () => window.location.reload(), true);


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
        document.getElementById("gold"      ).innerHTML = this.Hero.gold;
        document.getElementById("potion"    ).innerHTML = this.Hero.potions;

        document.getElementById("str_score" ).innerHTML = this.Hero.str_score;
        document.getElementById("dex_score" ).innerHTML = this.Hero.dex_score;
        document.getElementById("int_score" ).innerHTML = this.Hero.int_score;
        document.getElementById("def_score" ).innerHTML = this.Hero.def_score;

        document.getElementById("class"     ).innerHTML = this.Hero.class;
        document.getElementById("class"     ).innerHTML = this.Hero.class;

        document.getElementById("redoOfHealer").disabled = this.Hero.potions > 0 ? false : true;

        document.querySelector(".chartoggle").style.borderColor = this.Hero.skillsPoint > 0 ? "rgb(229, 201, 48)" : "rgba(255, 255, 255, 0.3)";

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

    async save() {
        await fetch("../API/Heros.php", {
            method: "POST",
            body : JSON.stringify({
                methode : "saveFight",
                id      : this._heroID,
                data    : this.Hero
            })
        });
    }

    async victory() {

        document.getElementById("monster").style.display = "none";
        document.getElementById("physical").style.display = "none";
        document.getElementById("magical").style.display = "none";

        this.Hero.experience += ( ( ~~( Math.random() * 15 ) + 10 ) * this.Hero.floor );
        this.Hero.gold += ( ( ~~( Math.random() * 10 ) + 5 ) );

        if (this.Hero.experience - this.Hero.level * 100  >= 0) {
	        this.Hero.experience = this.Hero.experience - this.Hero.level * 100

	        if (this.Hero.class === "Rogue")
                this.Hero.dex_score++;

	        if (this.Hero.class === "Figther")
                this.Hero.str_score++;

	        if (this.Hero.class === "Mage")
                this.Hero.int_score++;

            this.Hero.skillsPoint+=3;
            this.Hero.maxHP++
            this.Hero.maxMP++
            this.Hero.level++

	        this.log(`${this.Hero.name} Gain a level, it is now level ${this.Hero.level} ! `)
            this.upgrade();
        }

        await this.save();
        this.updateHeroUI();

        document.getElementById("level").innerText = this.Hero.level
        document.getElementById("exp").innerText = this.Hero.experience

        const retryBtn = document.getElementById("retry")
            , nextFBtn = document.getElementById("nextfloor");

        retryBtn.style.display = "block";
        nextFBtn.style.display = "block";

        retryBtn.addEventListener("click", () => {
            window.location.reload();
        }, true);

        nextFBtn.addEventListener("click", async () => {

            await fetch("../API/Heros.php", {
                method: "POST",
                body : JSON.stringify({
                    methode : "saveFloor",
                    id      : this._heroID,
                    floor   : ++this.Hero.floor
                })
            });

            window.location.reload();

        }, true);
    }

    async dead() {

        await fetch("../API/Heros.php", {
            method: "POST",
            body : JSON.stringify({
                methode : "deadHero",
                id      : this._heroID,
            })
        })

        document.location.replace( "../?DESTROYME=true" );

    }

    log(content) {

        var oUl = document.getElementById("messages");

        var oLi = document.createElement("li");
        var oText = document.createTextNode(content);

        oLi.appendChild(oText);
        oUl.appendChild(oLi);

    }

    loadInteractions() {

        const physical = document.getElementById("physical")
            , magical  = document.getElementById("magical")
            , potion   = document.getElementById("redoOfHealer");

        physical.style.display = "inline"
        magical.style.display = "inline"
        potion.style.display = "inline"

        physical.addEventListener("click", () => this.damages("physical"));
        magical.addEventListener("click", () => this.damages("magical"));
        potion.addEventListener("click", () => {

            if (this.Hero.maxHP === this.Hero.HP)
                return this.log("D E B I L U")

            console.log("test")

            this.Hero.HP = ( this.Hero.HP + 10 ) > this.Hero.maxHP ? this.Hero.maxHP : this.Hero.HP + 10;
            this.Hero.potions--

            this.save();
            this.updateHeroUI();

        });

    }

    damages(type){

        const physical = document.getElementById("physical")
            , magical  = document.getElementById("magical");

        physical.toggleAttribute("disabled");
        magical.toggleAttribute("disabled");

        let damages = Math.round(this.Hero[type === "physical" ? "str_score" : "int_score"] * (100/(100 + (this.target.eBaseDef) * 4)));


        if (type === "magical") {
            if (this.Hero.MP < 3)
                return this.log("You can't use spell without mana !");
            else {

                damages *= 1.5;
                this.Hero.MP -= 3;
                this.updateHeroUI();
            }
        }

        if ((Math.random() * 100) < this.Hero.dex_score) {

            damages *= 2;
            this.log(`Critical hit! ${this.Hero.name} inflicts ${damages} damage to ${this.target.eName} ${ type === "physical" ? "" : "with fire breath"}`)

        } else {

            this.log(`${this.Hero.name} inflicts ${damages} damage to ${this.target.eName} ${ type === "physical" ? "" : "with fire breath"}`)

        }

        this.target.HP -= damages;

        if (this.target.HP <= 0)
            return this.victory();
        else
            this.updateMonsterUI()

        setTimeout(() => {

            const damages = Math.round(this.target.eBaseStr * (100/(100+ (this.Hero.eBaseDef) * 4)));

            this.Hero.HP -= damages;

            this.log(`${this.target.eName } responds by inflicting ${damages} damages too.`)

            physical.toggleAttribute("disabled");
            magical.toggleAttribute("disabled");

            if (this.Hero.HP <= 0)
                this.dead();
            else
                return this.updateHeroUI();

        }, 200)



    }

    upgrade() {

        const str_scoreAdd = document.getElementById("str_scoreAdd")
            , dex_scoreAdd = document.getElementById("dex_scoreAdd")
            , int_scoreAdd = document.getElementById("int_scoreAdd")
            , def_scoreAdd = document.getElementById("def_scoreAdd");

            str_scoreAdd.style.display = "inline";
            dex_scoreAdd.style.display = "inline";
            int_scoreAdd.style.display = "inline";
            def_scoreAdd.style.display = "inline";

        str_scoreAdd.addEventListener("click", (e) => this.setSkill(e.originalTarget.id));
        dex_scoreAdd.addEventListener("click", (e) => this.setSkill(e.originalTarget.id));
        int_scoreAdd.addEventListener("click", (e) => this.setSkill(e.originalTarget.id));
        def_scoreAdd.addEventListener("click", (e) => this.setSkill(e.originalTarget.id));

    }

    async setSkill(arg) {

        const str_scoreAdd = document.getElementById("str_scoreAdd")
            , dex_scoreAdd = document.getElementById("dex_scoreAdd")
            , int_scoreAdd = document.getElementById("int_scoreAdd")
            , def_scoreAdd = document.getElementById("def_scoreAdd");

            this.Hero[arg.slice(0, 9)]++
            this.Hero.skillsPoint--;

            if (this.Hero.skillsPoint === 0) {
                str_scoreAdd.style.display = "none";
                dex_scoreAdd.style.display = "none";
                int_scoreAdd.style.display = "none";
                def_scoreAdd.style.display = "none";
            }

            await this.save();
            this.updateHeroUI();

        }

}