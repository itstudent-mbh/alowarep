<template>
    <div class="card bg-light">
        <div class="card-body">
            <!-- Comment form-->
            <form class="mb-4">
                <div class="form-group">
                    <input class="form-control" type="text" name="user_name" placeholder="Your name">
                    <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                    <input class="form-control" type="submit" value="send">
                </div>
            </form>
            <!-- Comment with nested comments-->
            <div class="d-flex mb-4" v-for="comment in comment_list" :comment="comment">
                <div class="flex-shrink-0"><img class="rounded-circle" src="https://random.imagecdn.app/50/50" alt="..." /></div>
                <div class="ms-3">
                    <div class="fw-bold">{{comment['user_name']}}</div>
                    {{comment['comment']}}
                    <a class="link-secondary" :comment_id ="comment['id']" href="" @click="openModal">Reply</a>
                    <div class="d-flex mt-4"  v-for="childComment in comment['childs']" :child_comment="childComment">
                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://picsum.photos/50/50" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold">{{childComment['user_name']}}</div>
                            {{childComment['comment']}}
                            <a class="link-secondary" :comment_id ="childComment['id']" data-toggle="modal" data-target="#reply_modal" href="">Reply</a>
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
</template>

<script>
    export default {
        props : ['comment_list'],

        methods : {
            formated (item) {
            //some code here
            }
        }
    }
</script>
