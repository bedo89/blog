<template>
    <div class="row">

        <div class="col-md-8" v-if="issearching">
            ..... Searching posts
        </div>

        <div class="col-md-8" v-else>
            <div class="media simple-post" v-for="post in posts.data" :key="post.id">
                <img class="mr-3" :src="'img/' + post.image " alt="Generic placeholder image">
                <div class="media-body">
                    <h4 class="mt-0">
                        <router-link :to="'/post/' + post.slug">{{ post.title }}</router-link>
                    </h4>
                    {{ post.body.substr(0, 180)}}
                    <ul class="list-inline list-unstyled d-flex post-info">
                        <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">{{ post.user.name }}</strong> </span>
                        </li>
                        <li>|</li>
                        <li><span><i class="fa fa-calendar"></i> {{ post.added_at }}, 8 hours </span></li>
                        <li>|</li>
                        <span><i class="fa fa-comment"></i> {{ post.comments_count }} comments</span>

                    </ul>
                </div>
            </div>
            <pagination :data="posts" @pagination-change-page="getPosts"></pagination>
        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." v-model="searchpost">
                        <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                    </div>
                </div>
            </div>

            <!-- Categories Widget -->
            <categories></categories>


        </div>
    </div>
</template>

<script>
    import categories from "./Categories"

    export default {
        data() {
            return {
                posts: {},
                searchpost: '',
                issearching: false
            }
        },
        components: {
            categories
        },
        watch:{
            searchpost(query){
                if(query.length > 0){
                    this.issearching=true;

                    axios.get('/api/searchposts/'+query)
                        .then(res => {

                            this.posts = res.data;
                            this.issearching=false;

                        })
                        .catch(err => {
                            console.log(err)
                        })
                }else{
                    let oldposts = JSON.parse(localStorage.getItem('posts'));
                    this.posts = oldposts;
                }
                console.log(this.issearching);
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts(page = 1) {
                axios.get('api/posts?page=' + page)
                    .then(res => {
                            this.posts = res.data;
                            localStorage.setItem('posts', JSON.stringify(this.posts));
                        }
                    )
                    .catch(err => console.log(err))
            }
        }
    }
</script>
