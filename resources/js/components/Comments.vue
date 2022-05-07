<template>
    <div>
        <Teleport to="body">
            <!-- use the modal component, pass in the prop -->
            <modal :show="showModal" :reply_to_id="reply_to_id" :reply_to="reply_to" @addreply="refreshList" @close="showModal = false">

            </modal>
        </Teleport>
        <div class="card bg-light">
                <!-- Comment with nested comments-->
            <div class="card-body">
                <!-- Comment form-->


                <div class="form-row">
                    <div class="col-auto">
                        <label class="sr-only" for="user_name">Name</label><span class="text-danger" v-if="showUserNameError"> is required</span>
                        <input type="text" class="form-control mb-2 has-error" name="user_name" id="user_name" placeholder="Enter your name..." v-model="user_name">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group">
                    <label for="user_name">Comment</label> <span class="text-danger" v-if="showCommentError"> is required</span>
                    <textarea class="form-control mb-2" id="user_name" name="user_name" rows="3" placeholder="Join the discussion and leave a comment!" v-model="comment"></textarea>
                    </div>
                    <div class="col-auto" style="text-align:right;">
                        <button @click="sendComment()" class="w-25 btn btn-primary mb-2">Send</button>
                    </div>
                </div>




                <div class="d-flex mb-4" v-for="comment in comment_list" :comment="comment">
                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://random.imagecdn.app/50/50" alt="..." /></div>
                    <div class="ms-3">
                        <div class="fw-bold">{{comment['user_name']}}</div>
                        {{comment['comment']}}
                        <span class="link-primary"  @click="show_Modal(comment['id'],comment['user_name'])">Reply</span>
                        <div class="d-flex mt-4"  v-for="childComment in comment['childs']" :child_comment="childComment">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://picsum.photos/50/50" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">{{childComment['user_name']}}</div>
                                {{childComment['comment']}}
                                <span class="link-primary"  href="#" @click="show_Modal(childComment['id'],childComment['user_name'])">Reply</span>
                                <div class="d-flex mt-4" v-for="grandchild in childComment['childs']" :grandchild_comment="grandchild">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://random.imagecdn.app/50/50" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">{{grandchild['user_name']}}</div>
                                        {{grandchild['comment']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';
    import Modal from './ReplyModal.vue'

        export default {
        props: ['post_comments'],
        components: {
            Modal
        },
        data() {
            return {
            showModal: false,
            showUserNameError:false,
            showCommentError:false,
            reply_to: '',
            reply_to_id: null,
            user_name:'',
            comment:'',
            comment_list: this.post_comments
            }
        },
        methods:{
            show_Modal(comment_id,user_name) {
                this.showModal = true;
                this.reply_to = user_name;
                this.reply_to_id = comment_id;
            },
            sendComment(reply_to_id = null){
                if(this.user_name == '') {
                    this.showUserNameError=true
                    return false;
                }
                if( this.comment == '') {
                    this.showCommentError=true
                    return false;
                }
                axios.post('/post/comment',{
                    user_name: this.user_name,
                    comment: this.comment,
                    post_comment_id: reply_to_id
                })
                .then((response) => {
                    if(Array.isArray(response.data))
                        this.comment_list= response.data;
                    else
                        this.comment_list.unshift(response.data);

                    this.user_name='';
                    this.comment='';
                    this.showUserNameError=false;
                    this.showCommentError=false;
                    })
                .catch((error) => {
                    if(error.response.data['errors']){
                        let errors = error.response.data['errors'];
                        if(errors.hasOwnProperty('user_name')) this.showUserNameError=true;
                        if(errors.hasOwnProperty('comment')) this.showCommentError=true;
                    }
                });
            },
            refreshList(newReplay){
                this.user_name=newReplay.user_name;
                this.comment=newReplay.comment;
                this.sendComment(newReplay.post_comment_id)
                this.showModal = false
            }

        }
    }
</script>
