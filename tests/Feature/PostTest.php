<?php

namespace Tests\Feature;

use App\Entities\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    private function name()
    {
        return 'custom-unique-name';
    }

    private function excerpt()
    {
        return 'text excerpt';
    }

    private function content()
    {
        return 'text content';
    }

    private function postFindBySlug($slug)
    {
        $res = Post::findBySlug($slug);
        return $res;
    }

    private function getPost()
    {
        $slug = generateSlug($this->name());
        return $this->postFindBySlug($slug);
    }

    private function postDeletePrevious()
    {
        $name = $this->name();
        Post::where('name', $name)->delete();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostStoreMethod()
    {
        $this->postDeletePrevious();

        $post = Post::create([
            'name' => $this->name(),
            'excerpt' => $this->excerpt(),
            'content' => $this->content(),
            'user_id' => 1
        ]);
        dump('New post id: ' . $post->id);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id
        ]);
        dump('Checked record id: ' . $post->id);
    }




    /**
     * Find post by slug.
     *
     * @return void
     */
    public function testFindBySlug()
    {
        $post = $this->getPost();
        dump('Found by slug id: ' . $post->id);

        $this->assertEquals(!empty($post), 1);
    }


    /**
     * Test name getter
     *
     * @return void
     */
    public function testPostNameGetter()
    {
        $name = $this->getPost()->getName();
        dump($name);

        $this->assertEquals(!empty($name), true);
    }


    /**
     * Test slug getter
     *
     * @return void
     */
    public function testPostSlugGetter()
    {
        $slug = $this->getPost()->getSlug();
        dump($slug);

        $this->assertEquals(!empty($slug), true);
    }


    /**
     * Test excerpt getter
     *
     * @return void
     */
    public function testPostExcerptGetter()
    {
        $excerpt = $this->getPost()->getExcerpt();
        dump($excerpt);

        $this->assertEquals(!empty($excerpt), true);
    }


    /**
     * Test content getter
     *
     * @return void
     */
    public function testPostContentGetter()
    {
        $content = $this->getPost()->getContent();
        dump($content);

        $this->assertEquals(!empty($content), true);
    }
}
