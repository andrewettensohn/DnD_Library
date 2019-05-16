<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<title>UGP Library</title>
</head>
<body>
    <div id="app">
        <template>
            <v-app id="inspire">

              <!--Toolbar-->
              <v-toolbar
                color="light-red"
                dark
                fixed
                app
                clipped-right
              >
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <v-spacer></v-spacer>
              </v-toolbar>
              <!--Toolbar-->
              <v-content>
                  <v-container grid-list-xs align-center text-xs-center>
                      <v-layout row wrap justify-center>
                      <v-flex xs6 sm5 md4>
                        <h1>UGP Tabletop Library</h1>
                      <p class="grey--text text--lighten-1">
                        "Mordhan awoke from his nightmare covered in sweat, clutching his heart. 
                        Maybe one day he'd tell his friends about these nightmare's, 
                        but his current worry was the all too relevant Owlbear mating season."
                      </p>
                      <v-btn  depressed small v-bind:color="btnAdventureColor" v-on:click="handler('Adventure', 'btnAdventureColor')">Adventure</v-btn>
                      <v-btn  depressed small v-bind:color="btnRuleBookColor" v-on:click="handler('Rule Book', 'btnRuleBookColor')" >Rule Book</v-btn>
                      <v-btn  depressed small v-bind:color="btnRuleSupplementColor" v-on:click="handler('Rule Supplement', 'btnRuleSupplementColor')">Rule Supplement</v-btn>
                      <v-btn  depressed small v-bind:color="btnSourceBookColor" v-on:click="handler('Source Book', 'btnSourceBookColor')">Source Book</v-btn>
                    </v-flex>
                    </v-layout>
                  </v-container>

                  <v-container grid-list-xs align-center text-xs-center>
                    <v-layout row wrap justify-center>
                  <v-flex xs12 md3>
                      <v-text-field 
                        v-on:change="searchFilter(searchTerm)"
                        v-model="searchTerm"
                        label="Let's see what's out there"
                        outline
                      ></v-text-field>
                    </v-flex>
                   </v-layout>
                  </v-container>
  
                </v-content>

                <template>
                <v-content>
                    <v-container grid-list-xl align-center>
                        <v-layout row justify-center wrap>
                            
                            <v-flex xs2 v-for="card in cardArray" :key="card.ID" :id="card.ID">
                                <v-card max-width="300px" max-height="550" min-height="550">
                                <a :href="card.URL">
                                <v-img
                                  :src="card.IMAGE"
                                  height="300px"
                                  contain
                                  alt="No Image"
                                >
                                </v-img>
                                </a>
                                <v-card-title primary-title>
                                  <div>
                                      <span ><h3>{{card.TITLE}}</h3></span><br>
                                    <span><b>{{card.GENRE}}</b></span><br>
                                    <span>{{card.DESCRIPTION}}</span>
                                  </div>
                                </v-card-title>
                                <div class="text-xs-center">
                                    <v-btn flat color="red">Add</v-btn>
                                    <v-btn flat color="red">D&D {{card.EDITION}}</v-btn>
                                  </div>
                              </v-card>
                              </v-flex>
              
                        </v-layout>
                      </v-container>
                </v-content>
              </template>

              <!--Left Drawer Content-->
              <v-navigation-drawer
                v-model="drawer"
                fixed
                app
                dark
              >
              <div>
                <v-btn depressed small color="error" v-on:click="genreFilter('Adventure')">Andrew</v-btn>
              </div>
              <div>
                <v-btn depressed small color="error" v-on:click="genreFilter('Rule Book')" >Nathan</v-btn>
              </div>  
              <div>
                <v-btn depressed small color="error" v-on:click="genreFilter('Rule Book')" >Carlos</v-btn>
                </div>  
              <div>
                <v-btn depressed small color="error" v-on:click="genreFilter('Rule Book')" >Quinn</v-btn>
              </div>
              <div>
                  <v-btn depressed small color="success" v-on:click="genreFilter('Rule Book')" >Maps</v-btn>
              </div>  
              <div>
                  <v-btn depressed small color="info" v-on:click="genreFilter('Rule Book')" >Timeline</v-btn>
              </div>  
              </v-navigation-drawer>
              <!--Left Drawer-->
              
          

            </v-app>
          </template>
    </div>


  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script>

let returnedCardData;

const app = new Vue({
    el: '#app',
    data: () => ({
      drawer: false,
      right: null,
      left: null,
      btnAdventureColor: "error",
      btnRuleBookColor: "error",
      btnRuleSupplementColor: "error",
      btnSourceBookColor: "error",
      searchTerm: null,
      activeGenreFilter: null,
      activeSearchFilter: null,
      cardArray: [],
  }),
  methods:{
    handler: function(genreType, btnActiveColor) {
      this.genreFilter(genreType)
      this.btnColor(btnActiveColor)
    },
      genreFilter: function(genreType) {

        if (genreType === this.activeGenreFilter) {
          this.cardArray = returnedCardData
          this.activeGenreFilter = null

        }
        else {
          this.cardArray = returnedCardData.filter(c => c.GENRE === genreType)
          this.activeGenreFilter = genreType
          
        }
      },  
     searchFilter: function(searchTerm){
      if(searchTerm === this.activeSearchFilter) {
        this.cardArray = returnedCardData
        this.activeSearchFilter = null
      }
      else if (this.activeGenreFilter != null) {
        this.cardArray = returnedCardData.filter(c => c.TITLE.toLowerCase().includes(searchTerm.toLowerCase()) && this.activeGenreFilter)
        this.activeSearchFilter = searchTerm
      }
      else {
        this.cardArray = returnedCardData.filter(c => c.TITLE.toLowerCase().includes(searchTerm.toLowerCase()))
        this.activeSearchFilter = searchTerm
     }
    },
      btnColor: function(btnActiveColor) {
        if (btnActiveColor == "btnAdventureColor") {
          if (this.btnAdventureColor == "error") {
            this.btnAdventureColor = "success"
          }
          else {
            this.btnAdventureColor = "error"
          }
        }
        else if (btnActiveColor == "btnRuleBookColor") {
          if (this.btnRuleBookColor == "error") {
            this.btnRuleBookColor = "success"
          }
          else {
            this.btnRuleBookColor = "error"
          }
        }
        else if (btnActiveColor == "btnRuleSupplementColor") {
          if (this.btnRuleSupplementColor == "error") {
            this.btnRuleSupplementColor = "success"
          }
          else {
            this.btnRuleSupplementColor = "error"
          }
        }
        else if (btnActiveColor == "btnSourceBookColor") {
          if (this.btnSourceBookColor == "error") {
            this.btnSourceBookColor = "success"
          }
          else {
            this.btnSourceBookColor = "error"
          }
        }
      }
    },
  mounted() {
          fetch('books_data.php')
            .then(response => response.json())
            .then((data) => {
              returnedCardData = data
              this.cardArray = data
      })
  },


  props: {
    source: String
  }
})

  // <v-btn depressed small color="error" v-on:click="genreFilter('genre.GENRE')">Adventures</v-btn>
    
</script>

</body>
</html>