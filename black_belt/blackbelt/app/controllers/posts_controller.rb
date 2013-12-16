class PostsController < ApplicationController
  def index
  	@posts = Post.find(:all).sort {|x,y| y.likes.count <=> x.likes.count}
  	@post=Post.new
  end

  def new
  end

  def create
  	@post = Post.new(post_params)
    @post.save
    redirect_to :back
  end

  def show
  	@post = Post.find(params[:id])
  	@likes = @post.likes
  end

  private
  	def post_params
  		params.require(:post).permit(:content, :user_id)
  	end

end