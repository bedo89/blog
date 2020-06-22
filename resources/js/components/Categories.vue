<template>

    <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                </div>
            </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0" v-if="categories.length > 0">
                            <li v-for="(category, index) in categories" :key="index">
                                <router-link :to="'#'">{{ category.name }}</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>

<script>
    export default {
        data() {
            return{
                categories: ''
            }
        },
        created() {
            this.getCategories();
        },
        methods:{
        getCategories(){
            axios.get('api/categories')
                .then(res => this.categories = res.data)
                .catch(err => console.log(err))
        }
        }

    }
</script>
