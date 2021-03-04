(async() => {

    // —— Variable declaration
    const form      = document.getElementById("createHeroForm")
        , wrapper   = document.querySelector(".wrapper")
        , abl_roll  = document.getElementById("abl_roll")

        , name      = document.getElementById("name")
        , str_score = document.getElementById("str_score")
        , dex_score = document.getElementById("dex_score")
        , int_score = document.getElementById("int_score")
        , def_score = document.getElementById("def_score")
        , race      = document.getElementById("race")
        , job       = document.getElementById("class")
        , gender    = document.getElementById("gender");

    let str_base    = dex_base = def_base = int_base = 6
    , races       = []
    , reroll      = 3;


    // —— Load races data
    for (let i = 1; i <= 5; i++)
        races.push(await fetchAPI('./API/Entity.php', { ID : i }));


    console.log(races)

    /** Event triggered when the user changes race
     * —— Impact of Race Change on Statistics */
    race.addEventListener("change", (e) => {

        str_score.innerText = str_base = parseInt(races[e.target.value - 1]._baseStr);
        dex_score.innerText = dex_base = parseInt(races[e.target.value - 1]._baseDex);
        int_score.innerText = int_base = parseInt(races[e.target.value - 1]._baseInt);
        def_score.innerText = def_base = parseInt(races[e.target.value - 1]._baseDef);

    }, true);


    /** Event triggered when the user clicks on the random statistic assignment button
     * —— Adds a random value to the basic statistics */
    abl_roll.addEventListener("click", () => {

        abl_roll.innerText = `Re-roll? ( ${--reroll} rolls left )`;

        str_score.innerText = str_roll = Math.floor(Math.random() * 10) + 1 + str_base;
        dex_score.innerText = dex_roll = Math.floor(Math.random() * 10) + 1 + dex_base;
        int_score.innerText = int_roll = Math.floor(Math.random() * 10) + 1 + int_base;
        def_score.innerText = def_roll = Math.floor(Math.random() * 10) + 1 + def_base;

        reroll === 0 && (abl_roll.style.display = "none");

    }, true);

    /** Event triggered when the user creates his character
     * —— Sends the information to the API, creates a new card */
    form.addEventListener("submit", async (e) => {

        e.preventDefault();

        try {

            // —— Send the required elements to the API
            const create = await fetch("./API/Utils.php", {
                method  : "POST",
                body    : JSON.stringify({

                    methode     : "create",

                    _IDUser     : idUser,
                    name        : name.value,
                    gender      : gender.value,
                    race        : race.value,
                    job         : job.value,
                    str_score   : str_score.innerHTML,
                    dex_score   : dex_score.innerHTML,
                    int_score   : int_score.innerHTML,
                    def_score   : def_score.innerHTML,
                    maxHP       : races[race.value - 1].maxHP,
                    HP          : races[race.value - 1].maxHP

                }),
                mode    : 'cors'
            }).then( ( res ) => res.json());

            // —— Reset the form and its different elements
            form.reset();
            str_score.innerText = dex_score.innerText = int_score.innerText = def_score.innerText = 6;

            reroll = 3;
            abl_roll.style.display = "initial";
            abl_roll.innerText = "Roll ability scores";

            const newHeroCard = document.createElement('form');

            newHeroCard.setAttribute('class', 'card');
            newHeroCard.setAttribute('method', 'POST');
            newHeroCard.setAttribute('id', create["_ID"]);

            newHeroCard.innerHTML = `

                <div class="flex" style="margin-bottom: 5px;">
                    <div class="char_port ${create["eName"]}_${create["gender"]}"></div>
                    <h2 class="heroName">${create["name"]}</h2>
                </div>

                <strong>An level ${create["level"]} ${create["eName"]} ${create["class"]}</strong>

                <div class="rollStats">

                    <abbr title="Strength — measuring physical power and carrying capacity"> Str:
                        <span>${create["str_score"]}</span>
                    </abbr>


                    <abbr title="Dexterity — measuring agility, balance, coordination and reflexes"> Dex:
                        <span>${create["dex_score"]}</span>
                    </abbr>


                    <abbr title="Intelligence — measuring deductive reasoning, cognition, knowledge, memory, logic and rationality"> Int:
                        <span>${create["int_score"]}</span>
                    </abbr>

                    <abbr title="Defense — measuring endurance, stamina and good health"> Def:
                        <span>${create["def_score"]}</span>
                    </abbr>

                </div>

                <p>${create["flore"]}</p>

                <button type="submit" value="${create["_ID"]}" name="characterChoice">Start</button>
                <button type="button" class="removeHero" value="${create["_ID"]}" name="remove">Delete</button>

            `;

            wrapper.insertBefore(newHeroCard, wrapper.childNodes[wrapper.childNodes.length - 2]);


        } catch (error) {
            console.log(error)
        }

    });

    /** Triggered when clicking on any item, forced to do this to take
     * into account the maps generated post loading.
     * (Filters only the "removeHero" class)
     * —— Send a character deletion request to the API
     * TODO: Refactor — Join with 'abl_roll' click event trigger :3
     * */
    document.addEventListener("click", async (e) => {

        if(e.target && e.target.classList.contains('removeHero')) {

            try {

                const hasRemoved = await fetch("./API/Utils.php", {
                    method  : "POST",
                    body    : JSON.stringify({
                        methode : "delete",
                        id      : e.target.value,
                    }),
                    mode    : 'cors'
                }).then( ( res ) => res.json());

                if ( hasRemoved === 1) {

                    const toRemove = document.getElementById(e.target.value);
                    toRemove.parentNode.removeChild(toRemove);

                }

            } catch (error) {
                console.log(error)
            }
        }

    }, true);

})();