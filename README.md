# Base for Scalable WordPress Projects


## Inspiration and Credits ♥

This project was inspired by the amazing work done by the following people:

https://engineering.hmn.md/how-we-work/style/

https://10up.github.io/Engineering-Best-Practices/

https://xwp.github.io/engineering-best-practices/

https://roots.io/bedrock/

https://www.cedaro.com/blog/structuring-wordpress-plugins/


## Introduction

I've made this repo to constantly evolve with new ideas and best practices. I use this as a base for new client projects.


## MU Plugin architecture

I've used [HumanMade's plugin loader](https://github.com/humanmade/hm-base) to load in MU plugins.


### A "Package" Vs. Multiple Plugins

The way you structure a project depends on the context in which you see a project. The best practice to write custom code is to separate it from the theme and add it to an `mu-plugin`.

#### Multiple Plugins 🤔

The most popular way to structure mu-plugins seems to be to write each "feature" as a separate plugin. The idea is to:

1. Make the code modular
1. Make the code re-usable
1. Make each plugin (module) do one thing
1. Make it easy to add and remove new features
1. Make it easy to maintain and test

That sounds great. But this quickly becomes a problem if you're working on a large website with a ton of features. The `mu-plugins` directory would start to get a little out of hand.

There's also the the problem of third-party mu-plugins. Creating a separation between the client's plugins and vendor plugins comes down to naming the folders. Some people create a `vendor` directory and add all third-party plugins there. So in other words, the `mu-plugins` directory "belongs" to the client and the `mu-plugins/vendor` directory "belongs" to every other vendor.

And then there's autoloading. Each feature plugin would require it's own autoloader. Some people define a global autoloader which they call within each feature plugin, and others define a new autoloader in each plugin.

#### A Single Package 🎉

This would all be simplified if we started to look at the custom code written for a client as a single "package". Doing this, we would:

1. Make a single directory for the client in the `mu-plugins` directory. All custom code for the client would live here
1. Each feature or module would be a subdirectory of this directory, and be it's own independant world. Feature directories / modules can be added or removed, just like an individual `mu-plugin` would, and can even have their own tests
1. Since each feature is it's own directory and world, it can be re-usable
1. Have a single autoloader for the entire package, giving structure to the project
1. Have a single bootstrap file within the package, where the features / modules can load in any particular order
1. Be free to share the `mu-plugins` directory with other custom code or vendor plugins. So it "belongs" to everyone
1. Make code sniffing and test configs much simpler
1. Make the whole package portable, so it can be moved around easily, depending on the host (think WordPress VIP)


## Composer and Git Submodules

Since Composer can also use Git repos, it makes more sense to just use Composer for dependancy management.


## Thoughts?

I'd love to hear thoughts on how to improve this! So feel free to create any issues

