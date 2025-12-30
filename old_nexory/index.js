import { motion } from "framer-motion";
import { Card, CardContent } from "@/components/ui/card";
import { Button } from "@/components/ui/button";

export default function NexoraLanding() {
  const fadeUp = {
    hidden: { opacity: 0, y: 40 },
    visible: { opacity: 1, y: 0 },
  };

  return (
    <div className="min-h-screen bg-black text-neutral-200 font-sans">

      {/* HERO */}
      <section className="h-screen flex items-center justify-center text-center px-6">
        <motion.div
          initial="hidden"
          animate="visible"
          variants={fadeUp}
          transition={{ duration: 0.8 }}
          className="max-w-4xl"
        >
          <h1 className="text-7xl font-semibold tracking-widest text-white">NEXORA</h1>
          <p className="mt-4 text-2xl text-neutral-400 italic">The Next Standard</p>
          <p className="mt-8 text-neutral-400 max-w-2xl mx-auto">
            Engineered objects. Refined control.
          </p>
        </motion.div>
      </section>

      {/* BRAND POSITIONING */}
      <section className="py-28 px-6 max-w-6xl mx-auto">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          transition={{ duration: 0.6 }}
          className="grid md:grid-cols-2 gap-16 items-center"
        >
          <h2 className="text-4xl text-white leading-tight">
            Not a device.<br />An engineered object.
          </h2>
          <p className="text-neutral-400 leading-relaxed">
            NEXORA exists to redefine the standard — not by excess, but by refinement.
            Every component is engineered with purpose. Every detail is deliberate.
            No shortcuts. No noise.
          </p>
        </motion.div>
      </section>

      {/* BRAND PERSONALITY */}
      <section className="py-28 px-6 bg-neutral-950">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          transition={{ duration: 0.6 }}
          className="max-w-5xl mx-auto text-center space-y-8"
        >
          <h2 className="text-3xl text-white">Brand DNA</h2>
          <p className="text-neutral-400">
            Clean. Intelligent. Confident. Built on engineering excellence and restrained power.
          </p>
          <p className="text-neutral-400">
            Designed for tech‑savvy, design‑aware audiences who value precision over noise.
          </p>
        </motion.div>
      </section>

      {/* PRODUCT ARCHITECTURE */}
      <section className="py-28 px-6">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          transition={{ duration: 0.6 }}
          className="max-w-7xl mx-auto"
        >
          <h2 className="text-3xl text-white mb-16 text-center">Product Architecture</h2>
          <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
            {[
              { name: "NEXORA ONE", desc: "Entry standard. Core performance." },
              { name: "NEXORA CORE", desc: "Balanced engineering. Daily precision." },
              { name: "NEXORA PRO", desc: "Flagship control. Maximum refinement." },
              { name: "NEXORA FRAME", desc: "Special edition. Museum‑grade display." },
            ].map((p) => (
              <Card key={p.name} className="bg-black border-neutral-800 rounded-2xl">
                <CardContent className="p-8 space-y-4">
                  <h3 className="text-xl text-white">{p.name}</h3>
                  <p className="text-neutral-400 text-sm">{p.desc}</p>
                  <Button variant="outline" className="border-neutral-700 text-neutral-200">
                    View Product
                  </Button>
                </CardContent>
              </Card>
            ))}
          </div>
        </motion.div>
      </section>

      {/* ENGINEERING BREAKDOWN */}
      <section className="py-28 px-6 bg-neutral-950">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          transition={{ duration: 0.6 }}
          className="max-w-6xl mx-auto"
        >
          <h2 className="text-3xl text-white mb-12">Engineered Inside</h2>
          <ul className="space-y-4 text-neutral-400">
            <li>Pod Module — Precision‑molded chamber</li>
            <li>Coil Assembly — Optimized heat distribution</li>
            <li>Power Cell — High‑density energy core</li>
            <li>Control Board — Advanced MCU regulation</li>
            <li>Airflow Sensor — Adaptive intake system</li>
            <li>USB‑C Interface — Fast, stable charging</li>
          </ul>
        </motion.div>
      </section>

      {/* MANIFESTO */}
      <section className="py-28 px-6 max-w-4xl mx-auto">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          transition={{ duration: 0.6 }}
          className="space-y-8 text-center"
        >
          <p className="italic text-neutral-400">We believe progress is not loud.</p>
          <p className="text-neutral-300 leading-relaxed">
            True advancement is measured, intentional, and precise.
            This is not about clouds or trends. This is about control.
          </p>
        </motion.div>
      </section>

      {/* BUSINESS CTA */}
      <footer className="py-20 px-6 text-center border-t border-neutral-800">
        <motion.div
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true }}
          variants={fadeUp}
          transition={{ duration: 0.6 }}
        >
          <h3 className="text-2xl text-white mb-4">Business & Partnership</h3>
          <p className="text-neutral-400 mb-6 max-w-xl mx-auto">
            NEXORA is built for long‑term collaboration, distribution, and premium market expansion.
          </p>
          <Button className="bg-white text-black rounded-2xl px-10">
            Contact Business Inquiry
          </Button>
        </motion.div>
      </footer>

    </div>
  );
}
