<?php

/**
 * Template Name: AI
 */

use WPUtil\{SVG};
use WPUtil\{Vendor};

get_header();

?>
<main class="tmpl-ai-page">
    <div class="banner banner-default bg-black-dark banner-default--side-image banner--no-bottom-arc">
        <div class="banner-default__inner contain">
            <div class="banner-default__text-content">
                <div>
                    <div>
                        <h1 class="banner-default__title">
                            The Most Advanced SQL-compatible Vector Solution<span>Public Beta</span>
                        </h1>
                    </div>

                    <div class="wysiwyg">
                        <p>TiDB is introducing a built-in vector search to the SQL database family, enabling support for your AI applications without requiring a new database or additional technical stacks. With vectors as a new data type in MySQL, you can now store and search for vectors directly using SQL.</p>
                        <br>
                        <div class="button-group"><a target="_blank" class="button" href="https://tidbcloud.com/free-trial/" data-gtag="event:go_to_cloud_signup,product_type:serverless,button_name:Start for Free,position:top_banner"><span class="custom-style-button">Start For Free</span></a><a target="_blank" class="button--secondary" href="https://docs.pingcap.com/tidbcloud/vector-search-overview"><span class="pr-1 underline">Documentation</span></a></div>
                    </div>
                </div>
            </div>
            <div class="banner-default__image-container">
                <div id="typewriter" class="typewriter"></div>
            </div>
        </div>
    </div>
    <section data-block-index="1" class="bg-black-dark block-container block-icon-grid block-index-1" aria-label="Icon Grid">
        <div class="block-inner contain">
            <div class="block-icon-grid__item-container" data-column-count="3">
                <div class="block-icon-grid__item wysiwyg">
                    <?php SVG::the_svg('ai/mysql-icon', ['no_use' => true]); ?>
                    <h4>MySQL & Vector All in One </h4>
                    <p>Eliminate redundancy. Store vector embeddings alongside MySQL data directly. No new DB, no data duplication. Just SQL simplicity.</p>
                </div>
                <div class="block-icon-grid__item wysiwyg">
                    <?php SVG::the_svg('ai/join', ['no_use' => true]); ?>
                    <h4>Join Multi-model Data with Ease</h4>
                    <p>Leverage familiar SQL to join, index, and query operational and vector data together, enabling advanced semantic searches with ease.</p>
                </div>
                <div class="block-icon-grid__item wysiwyg">
                    <?php SVG::the_svg('ai/ai', ['no_use' => true]); ?>
                    <h4>Vast Array of Use Cases </h4>
                    <p>Powering RAG, semantic searches and more, with integrations like OpenAI, Hugging Face, LangChain, and LlamaIndex, etc.</p>
                </div>
            </div>

        </div>
    </section>
    <section data-block-index="2" class="bg-black-dark block-container block-index-2 integrations">
        <div class="block-inner contain">
            <div class="block-section__title-container">
                <h2 class="block-section__title">Comprehensive ecosystem of AI Integrations</h2>
                <p class="block-section__title-desc">Simplify your development process by leveraging TiDB's seamless integrations with leading AI vendors and frameworks</p>
            </div>
            <div class="integrations__image">
                <div class="image-container"><img alt="llamaIndex" loading="lazy" width="290" height="57" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/llamaIndex.png 1x, https://static.pingcap.com/_next/public/ai/llamaIndex.png 2x" src="https://static.pingcap.com/_next/public/ai/llamaIndex.png"></div>
                <div class="image-container"><img alt="dify" loading="lazy" width="194" height="71" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/dify.png 1x, https://static.pingcap.com/_next/public/ai/dify.png 2x" src="https://static.pingcap.com/_next/public/ai/dify.png"></div>
                <div class="image-container"><img alt="leptonAI" loading="lazy" width="268" height="66" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/leptonAI.png 1x, https://static.pingcap.com/_next/public/ai/leptonAI.png 2x" src="https://static.pingcap.com/_next/public/ai/leptonAI.png"></div>
                <div class="image-container"><img alt="langChain" loading="lazy" width="294" height="44" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/langChain.png 1x, https://static.pingcap.com/_next/public/ai/langChain.png 2x" src="https://static.pingcap.com/_next/public/ai/langChain.png"></div>
                <div class="image-container"><img alt="jido" loading="lazy" width="162" height="69" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/jido.png 1x, https://static.pingcap.com/_next/public/ai/jido.png 2x" src="https://static.pingcap.com/_next/public/ai/jido.png"></div>
                <div class="image-container"><img alt="bentoML" loading="lazy" width="214" height="93" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/bentoML.png 1x, https://static.pingcap.com/_next/public/ai/bentoML.png 2x" src="https://static.pingcap.com/_next/public/ai/bentoML.png"></div>
                <div class="image-container"><img alt="npiAI" loading="lazy" width="209" height="67" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/npiAI.png 1x, https://static.pingcap.com/_next/public/ai/npiAI.png 2x" src="https://static.pingcap.com/_next/public/ai/npiAI.png"></div>
                <div class="image-container"><img alt="hugging" loading="lazy" width="280" height="52" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/hugging.png 1x, https://static.pingcap.com/_next/public/ai/hugging.png 2x" src="https://static.pingcap.com/_next/public/ai/hugging.png"></div>
                <div class="image-container"><img alt="openAI" loading="lazy" width="194" height="52" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/openAI.png 1x, https://static.pingcap.com/_next/public/ai/openAI.png 2x" src="https://static.pingcap.com/_next/public/ai/openAI.png"></div>
                <div class="image-container"><img alt="cohere" loading="lazy" width="245" height="43" decoding="async" data-nimg="1" style="color:transparent" srcset="https://static.pingcap.com/_next/public/ai/cohere.png 1x, https://static.pingcap.com/_next/public/ai/cohere.png 2x" src="https://static.pingcap.com/_next/public/ai/cohere.png"></div>
            </div>
        </div>
    </section>
    <section data-block-index="3" class="bg-black-dark block-container block-index-3 feature">
        <div class="block-inner contain">
            <div class="feature__container">
                <div class="max-w-484px flex-1">
                    <h3>Experience Superior Search and AI Performance<br>with TiDB</h3>
                    <img src="https://static.pingcap.com/files/2024/09/11022447/feature.svg" alt="">
                </div>
                <div>
                    <div class="flex-1 space-y-14">
                        <div class="feature__card">
                            <?php SVG::the_svg('ai/eye'); ?>
                            <div class="flex-1">
                                <h4 class="py-4 text-2xl font-medium leading-tight text-[#98DCFF]">Semantic search with high performance and accuracy</h4>
                                <p>Leverage your existing MySQL expertise to seamlessly integrate advanced vector search</p>
                                <ul class="ml-4 mt-4 list-outside list-disc">
                                    <li>Knowledge graph integration to improve query performance</li>
                                    <li>Auto scaling to support resource-intensive AI workloads</li>
                                    <li>Columnar data store</li>
                                </ul>
                            </div>
                        </div>
                        <div class="feature__card">
                            <?php SVG::the_svg('ai/activities'); ?>
                            <div class="flex-1">
                                <h4 class="py-4 text-2xl font-medium leading-tight text-[#98DCFF]">Unified database solution for enhanced developer experience</h4>
                                <p>Simplify your tech stack with a single, scalable database for both traditional and AI workloads</p>
                                <ul class="ml-4 mt-4 list-outside list-disc">
                                    <li>Serverless to get started instantly</li>
                                    <li>Supports transactional, analytical and vector search workloads</li>
                                    <li>Native integrations with OpenAI, LlamaIndex, HuggingFace etc.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="feature__card">
                            <?php SVG::the_svg('ai/mysql'); ?>
                            <div class="flex-1">
                                <h4 class="py-4 text-2xl font-medium leading-tight text-[#98DCFF]">MySQL compatible</h4>
                                <p>Leverage your existing MySQL expertise to seamlessly integrate advanced vector search</p>
                                <ul class="ml-4 mt-4 list-outside list-disc">
                                    <li>New “Vector” datatype and similarity search indexes</li>
                                    <li>Store data and vector embeddings together</li>
                                    <li>Join, index, and query both operational and vector data with SQL</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-block-index="4" class="bg-black-dark block-container block-index-4 develop">
        <div class="block-inner contain">
            <div class="block-columns__column wysiwyg">
                <div class="block-section__title-container">
                    <h2 class="block-section__title">Simplest way to create end-to-end<br>RAG-Enabled Search Apps</h2>
                    <div class="block-section__title-desc">TiDB's vector search capabilities make it incredibly easy to integrate Retrieval-Augmented Generation (RAG) into your applications</div>
                </div>
                <div class="develop__tabs">
                    <div class="develop__tabs-menu">
                        <div class="develop__tabs-tab" data-tab="develop-1">Connect to a TiDB cloud cluster</div>
                        <div class="develop__tabs-tab" data-tab="develop-2">Create table and vector index</div>
                        <div class="develop__tabs-tab" data-tab="develop-3">Create embedding vector and save data</div>
                        <div class="develop__tabs-tab" data-tab="develop-4">Retrieve content</div>
                    </div>
                    <div class="develop__tabs-panel">
                        <div class="develop__tabs-content" id="develop-1">
                            <pre>
                                <code class="language-python">
engine = create_engine(your_tidb_url)
                                </code>
                            </pre>
                        </div>
                        <div class="develop__tabs-content" id="develop-2">
                            <pre>
                                <code class="language-python">
class Entity(Base):
    __tablename__ = "entity"

    id = Column(Integer, primary_key=True)
    content = Column(Text)
    content_vec = Column(
        VectorType(dim=dim_of_embedding_model),
        comment="hnsw(distance=l2)"
    )

Base.metadata.create_all(engine)
                                </code>
                            </pre>
                        </div>
                        <div class="develop__tabs-content" id="develop-3">
                            <pre>
                                <code class="language-python">
content = 'TiDB is an open-source distributed SQL database'

open_ai_client = openai.OpenAI(api_key=open_ai_api_key)
embedding = open_ai_client.embeddings.create(
   input=[content], model=model_name).data[0].embedding

with Session(engine) as session:
   session.add(Entity(content = content, content_vec = embedding))
   session.commit()
                                </code>
                            </pre>
                        </div>
                        <div class="develop__tabs-content" id="develop-4">
                            <pre>
                                <code class="language-python">
query = 'What is TiDB?'

embedding_query = open_ai_client.embeddings.create(
   input=[query], model=model_name).data[0].embedding

with Session(engine) as session:
   entity = session.query(Entity).order_by(
   Entity.content_vec.cosine_distance(embedding_query)
   ).limit(1).first()

   print(entity.content)
                                </code>
                            </pre>
                        </div>
                    </div>
                    <div class="develop__tabs-mb">
                        <div class="develop__tabs-tab-mb">Connect to a TiDB cloud cluster</div>
                        <div class="develop__tabs-panel-mb">
                            <div class="develop__tabs-content-mb" id="develop-1">
                                <pre>
                                <code class="language-python">
engine = create_engine(your_tidb_url)
                                </code>
                            </pre>
                            </div>
                        </div>
                        <div class="develop__tabs-tab-mb">Create table and vector index</div>
                        <div class="develop__tabs-panel-mb">

                            <div class="develop__tabs-content-mb" id="develop-2">
                                <pre>
                                <code class="language-python">
class Entity(Base):
    __tablename__ = "entity"

    id = Column(Integer, primary_key=True)
    content = Column(Text)
    content_vec = Column(
        VectorType(dim=dim_of_embedding_model),
        comment="hnsw(distance=l2)"
    )

Base.metadata.create_all(engine)
                                </code>
                            </pre>
                            </div>
                        </div>
                        <div class="develop__tabs-tab-mb">Create embedding vector and save data</div>
                        <div class="develop__tabs-panel-mb">
                            <div class="develop__tabs-content-mb" id="develop-3">
                                <pre>
                                <code class="language-python">
content = 'TiDB is an open-source distributed SQL database'

open_ai_client = openai.OpenAI(api_key=open_ai_api_key)
embedding = open_ai_client.embeddings.create(
   input=[content], model=model_name).data[0].embedding

with Session(engine) as session:
   session.add(Entity(content = content, content_vec = embedding))
   session.commit()
                                </code>
                            </pre>
                            </div>
                        </div>
                        <div class="develop__tabs-tab-mb">Retrieve content</div>
                        <div class="develop__tabs-panel-mb">
                            <div class="develop__tabs-content-mb" id="develop-4">
                                <pre>
                                <code class="language-python">
query = 'What is TiDB?'

embedding_query = open_ai_client.embeddings.create(
   input=[query], model=model_name).data[0].embedding

with Session(engine) as session:
   entity = session.query(Entity).order_by(
   Entity.content_vec.cosine_distance(embedding_query)
   ).limit(1).first()

   print(entity.content)
                                </code>
                            </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-block-index="5" class="bg-black-dark block-container block-index-5 case">
        <div class="block-inner contain">
            <div class="block-section__title-container">
                <h2 class="block-section__title">Key Use Cases Where Scalability<br />and Vector Search Meet</h2>
            </div>
            <div class="case__container">
                <div class="case__card">
                    <div class="case__card-container">
                        <?php SVG::the_svg('ai/real', ['no_use' => true]); ?>
                        <h5 class="my-4 text-xl font-bold">Real-Time Recommendation Systems</h5>
                        <p>Understand user preferences and similarities between products to deliver accurate recommendations</p>
                    </div>
                </div>
                <div class="case__card">
                    <div class="case__card-container">
                        <?php SVG::the_svg('ai/chatbot', ['no_use' => true]); ?>
                        <h5 class="my-4 text-xl font-bold">Chatbots and Virtual Assistants</h5>
                        <p>Handle numerous concurrent customer interactions using vector search to provide quick and accurate responses</p>
                    </div>
                </div>
                <div class="case__card">
                    <div class="case__card-container">
                        <?php SVG::the_svg('ai/image', ['no_use' => true]); ?>
                        <h5 class="my-4 text-xl font-bold">Image and Video Recognition</h5>
                        <p>Implement robust image and video analysis for content moderation</p>
                    </div>
                </div>
                <div class="case__card">
                    <div class="case__card-container">
                        <?php SVG::the_svg('ai/nlp', ['no_use' => true]); ?>
                        <h5 class="my-4 text-xl font-bold">NLP Applications</h5>
                        <p>Perform sentiment analysis, language translation, and text summarization for more accurate processing</p>
                    </div>
                </div>
                <div class="case__card md:col-start-2">
                    <div class="case__card-container">
                        <?php SVG::the_svg('ai/ad', ['no_use' => true]); ?>
                        <h5 class="my-4 text-xl font-bold">Ad Targeting and Personalization</h5>
                        <p>Analyze user behavior and preferences to serve the most relevant ads</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php Vendor\BlueprintBlocks::safe_display(); ?>
    
</main>
<?php

get_footer();
