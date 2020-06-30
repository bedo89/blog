<template>
    <div class="row">
        <div class="col-md-8">
            <div :key="post.id" class="media simple-post" v-for="post in posts">
                <img :src="'/img/' + post.image " alt="Generic placeholder image" class="mr-3">
                <div class="media-body">
                    <h4 class="mt-0">
                        <router-link :to="'/post/' + post.slug">{{ post.title }}</router-link>
                    </h4>
                    {{ post.body.substr(0, 180)}}
                    <ul class="list-inline list-unstyled d-flex post-info">
                        <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary" v-if="post.user">{{ post.user.name }}</strong> </span>
                        </li>
                        <li>|</li>
                        <li><span><i class="fa fa-calendar"></i> {{ post.added_at }}, 8 hours </span></li>
                        <li>|</li>
                        <span><i class="fa fa-comment"></i> {{ post.comments_count }} comments</span>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">

            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search for..." type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import categories from "./Categories"

    export default {
        data() {
            return {
                posts: []
            }
        },
        components: {
            categories
        },
        mounted() {
            console.log('Component mounted.')
            this.getPosts();
        },
        methods: {
            getPosts() {
                axios.get('/api/category/' + this.$route.params.slug + '/posts')
                    .then(res => {
                            console.log(res.data);
                            this.posts = res.data;
                        }
                    )
                    .catch(err => console.log(err))
            }
        }
    }
</script>
